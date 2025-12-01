<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="leafletMarkerComponent({
            id: '{{ $getId() }}',
            height: {{ $getHeight() }},
            lat: @js($getRecord()?->latitude),
            lng: @js($getRecord()?->longitude),
            editable: {{ $operation !== 'view' ? 'true' : 'false' }},
            livewireId: @this.__instance.id,
            iconApiUrl: '{{ route('api.icons.show') }}',
        })" wire:ignore
        style="height: {{ $getHeight() }}px; border-radius: 10px; z-index: 1;">
        <div id="{{ $getId() }}"
            class="rounded-lg overflow-hidden w-full h-full"
            style="height: {{ $getHeight() }}px; z-index: 1; border-radius: 10px;">
        </div>
    </div>
</x-dynamic-component>

@script
<script>
    window.leafletMarkerComponent = (options) => ({
    map: null,
    markerLayer: null,
    currentIcon: @entangle('data.icon').defer,
    iconCache: {},

    async init() {
        const el = document.getElementById(options.id);

        if (el._leafletMap) el._leafletMap.remove();

        this.map = L.map(el).setView([options.lat ?? 0, options.lng ?? 0], options.lat ? 13 : 2);
        el._leafletMap = this.map;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(this.map);
        this.markerLayer = L.featureGroup().addTo(this.map);

        if (options.lat && options.lng) {
            await this.addMarker([options.lat, options.lng]);
        }

        if (options.editable) {
            const drawControl = new L.Control.Draw({
                edit: { featureGroup: this.markerLayer },
                draw: {
                    polygon: false,
                    polyline: false,
                    rectangle: false,
                    circle: false,
                    circlemarker: false,
                    marker: true,
                },
            });
            this.map.addControl(drawControl);

            this.map.on(L.Draw.Event.CREATED, async (e) => {
                this.markerLayer.clearLayers();
                this.markerLayer.addLayer(e.layer);
                this.updateLatLng(e.layer);
            });

            this.map.on('draw:edited', (e) => {
                e.layers.eachLayer(layer => this.updateLatLng(layer));
            });
        }

        // Watch perubahan icon dari Filament IconPicker
        this.$watch('currentIcon', async (newIcon) => {
            await this.updateMarkerIcon(newIcon);
        });
    },

    async fetchIconHtml(iconName) {
        if (!iconName) return '<div class="text-blue-600">📍</div>';

        // Cache biar gak fetch berkali-kali
        if (this.iconCache[iconName]) return this.iconCache[iconName];

        try {
            const res = await fetch(`${options.iconApiUrl}?name=${iconName}`);
            const data = await res.json();
            if (data?.html) {
                this.iconCache[iconName] = data.html;
                return data.html;
            }
        } catch (err) {
            console.error('Icon fetch failed:', err);
        }

        return '<div class="text-blue-600">📍</div>';
    },

    async addMarker(latlng) {
        const iconHtml = await this.fetchIconHtml(this.currentIcon);
        const icon = L.divIcon({
            html: iconHtml,
            className: 'filament-leaflet-icon',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
        });

        const marker = L.marker(latlng, { icon }).addTo(this.markerLayer);
        this.map.setView(latlng, 13);
        return marker;
    },

    updateLatLng(layer) {
        const { lat, lng } = layer.getLatLng();
        Livewire.find(options.livewireId)?.set('data.latitude', lat);
        Livewire.find(options.livewireId)?.set('data.longitude', lng);
    },

    async updateMarkerIcon(iconName) {
        if (!this.markerLayer) return;
        const iconHtml = await this.fetchIconHtml(iconName);

        this.markerLayer.eachLayer(layer => {
            if (layer instanceof L.Marker) {
                const newIcon = L.divIcon({
                    html: iconHtml,
                    className: 'filament-leaflet-icon',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                });
                layer.setIcon(newIcon);
            }
        });
    },
});
</script>

<style>
    .filament-leaflet-icon svg {
        width: 28px;
        height: 28px;
        stroke: #1e40af;
        stroke-width: 1.5;
    }
</style>
@endscript