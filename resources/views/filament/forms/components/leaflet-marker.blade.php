<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ state: $wire.$entangle(@js($getStatePath())) }" {{
        $getExtraAttributeBag() }}>

        <div id="{{ $getId() }}"
            style="height: {{ $getHeight() }}px; z-index: 1; border-radius: 10px;"
            wire:ignore>
        </div>
    </div>
</x-dynamic-component>

@script
<script>
    const el = document.getElementById('{{ $getId() }}');

    if (el._leafletMap) {
        el._leafletMap.remove();
    }

    const map = L.map(el).setView([0, 0], 2);
    el._leafletMap = map;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    const drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    // Get existing coordinates from Filament/Livewire
    const lat = @js($getRecord()?->latitude ?? null);
    const lng = @js($getRecord()?->longitude ?? null);

    // Restore marker if lat/lng exist
    if (lat && lng) {
        const marker = L.marker([lat, lng]).addTo(drawnItems);
        map.setView([lat, lng], 13);
    }

    // Only enable draw controls when editing or creating
    if ({{ $operation !== 'view' ? 'true' : 'false' }}) {
        const drawControl = new L.Control.Draw({
            edit: { featureGroup: drawnItems },
            draw: {
                polygon: false,
                polyline: false,
                rectangle: false,
                circle: false,
                circlemarker: false,
                marker: true,
            },
        });
        map.addControl(drawControl);

        const updateLatLng = (layer) => {
            const { lat, lng } = layer.getLatLng();
            console.log(layer.getLatLng);
            $wire.set('data.latitude', lat);
            $wire.set('data.longitude', lng);
        };

        map.on(L.Draw.Event.CREATED, function (e) {
            drawnItems.clearLayers();
            drawnItems.addLayer(e.layer);
            updateLatLng(e.layer);
        });

        map.on('draw:edited', function (e) {
            e.layers.eachLayer(layer => updateLatLng(layer));
        });
    }
</script>
@endscript