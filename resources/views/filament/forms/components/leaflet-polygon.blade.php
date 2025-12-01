<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div id="{{ $getId() }}"
        style="height: {{ $getHeight() }}px; z-index: 1; border-radius: 10px;"
        wire:ignore>
    </div>

    @if($getStatePath())
    <input type="hidden" id="input-{{ $getId() }}"
        wire:model="{{ $getStatePath() }}">
    @endif
</x-dynamic-component>

@once
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    window.LDraw = window.L.noConflict(true);
</script>
<script
    src="https://cdn.jsdelivr.net/npm/leaflet-draw@1.0.4/dist/leaflet.draw.js">
</script>
<script>
    // Bind Draw plugin to LDraw
        LDraw.Control = L.Control;
        LDraw.Draw = L.Draw;
        LDraw.FeatureGroup = L.FeatureGroup;
</script>
@endonce

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

    const coordsInput = document.getElementById('input-{{ $getId() }}');
    const coords = @json($getState() ?? []);

    if (coords && Array.isArray(coords) && coords.length > 0) {
        const polygons = Array.isArray(coords[0][0]) ? coords : [coords];
        polygons.forEach(polygonCoords => {
            const poly = L.polygon(polygonCoords).addTo(drawnItems);
        });
        map.fitBounds(drawnItems.getBounds());
    }

    if ({{ $operation !== 'view' ? 'true' : 'false' }}) {
        const drawControl = new L.Control.Draw({
            edit: { featureGroup: drawnItems },
            draw: { polygon: true, polyline: false, rectangle: false, circle: false, marker: false, circlemarker: false, },
        });
        map.addControl(drawControl);
        
        const updateCoordsInput = (layer) => {
            const coordinates = layer.getLatLngs()[0].map(p => [p.lat, p.lng]);
            coordsInput.value = JSON.stringify(coordinates);

            const polygon = turf.polygon([[...coordinates, coordinates[0]]]);
            const area = turf.area(polygon);
            const areaHectare = area / 10000;

            $wire.set('data.area', areaHectare);
            coordsInput.dispatchEvent(new Event('input'));
        };

        map.on(L.Draw.Event.CREATED, function(e) {
            drawnItems.clearLayers();
            drawnItems.addLayer(e.layer);
            updateCoordsInput(e.layer);
        });
        
        map.on('draw:edited', function(e) {
            e.layers.eachLayer(layer => updateCoordsInput(layer));
        });
    }
</script>
@endscript