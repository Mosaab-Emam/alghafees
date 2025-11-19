<x-filament-panels::page>
    <script>
        (function() {
            function addInfoWindowHandlers() {
                if (!window.google || !window.google.maps) {
                    setTimeout(addInfoWindowHandlers, 100);
                    return;
                }

                const mapWidget = document.querySelector('.filament-google-maps-widget');
                if (!mapWidget) {
                    setTimeout(addInfoWindowHandlers, 100);
                    return;
                }

                const alpineElement = mapWidget.querySelector('[x-data]');
                if (!alpineElement || !window.Alpine) {
                    setTimeout(addInfoWindowHandlers, 100);
                    return;
                }

                try {
                    const component = window.Alpine.$data(alpineElement);
                    if (component && component.markers && component.markers.length > 0 && component.data) {
                        // Create info window if it doesn't exist
                        if (!component.infoWindow) {
                            component.infoWindow = new google.maps.InfoWindow({
                                content: "",
                                disableAutoPan: true,
                            });
                        }

                        // Add click handlers to all markers
                        component.markers.forEach(function(marker, index) {
                            if (component.data[index] && component.data[index].label) {
                                // Clear any existing click listeners
                                google.maps.event.clearListeners(marker, 'click');
                                
                                const locationData = component.data[index];
                                
                                // Add click handler that only shows info window
                                marker.addListener('click', function() {
                                    // Show info window (which contains the clickable link)
                                    component.infoWindow.setContent(locationData.label);
                                    component.infoWindow.open(component.map, marker);
                                });
                            }
                        });
                    } else {
                        // Markers not ready yet, try again
                        setTimeout(addInfoWindowHandlers, 200);
                    }
                } catch (e) {
                    console.error('Error adding info window handlers:', e);
                    setTimeout(addInfoWindowHandlers, 500);
                }
            }

            // Start checking once DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', addInfoWindowHandlers);
            } else {
                addInfoWindowHandlers();
            }
        })();
    </script>
</x-filament-panels::page>
