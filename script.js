let map;

async function fetchRestaurants() {
    const response = await fetch("get_restaurant.php");
    return response.json();
}


// Function to initialize the map
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 30.2672, lng: -97.7431 }, // Default to Austin
        zoom: 10, // Default zoom level
        mapId: "1e2a3160b712497f"
    });

    const geocoder = new google.maps.Geocoder();
    const infoWindow = new google.maps.InfoWindow();
    
    fetchRestaurants().then((restaurants) => {
        restaurants.forEach((restaurant) => {
            // Use geocoder to convert address to latitude/longitude
            console.log(restaurant);
            geocoder.geocode({ address: restaurant.address }, (results, status) => {
                if (status === google.maps.GeocoderStatus.OK) {
                    const location = results[0].geometry.location;

                    // Create a marker for each restaurant
                    const marker = new google.maps.Marker({
                        position: location,
                        map,
                        title: restaurant.restaurant_name,
                    });

                    marker.addListener("click", async () => {
                        const inventory = await fetch(`get_inventory.php?restaurant_id=${restaurant.id}`).then(res => res.json());
                        
                        // Check if inventory data is available
                        const inventoryList = inventory.length
                            ? inventory.map(item => `<li>${item.food_type}: ${item.amount}</li>`).join("")
                            : "<li>No inventory available</li>";

                        const contentString = `
                            <div style="max-width: 200px;">
                                <h3 style="margin: 20;padding: 10">${restaurant.restaurant_name}</h3>
                                <ul>${inventoryList}</ul>
                            </div>
                        `;

                        infoWindow.setContent(contentString);
                        infoWindow.open(map, marker);
                    });
                } else {
                    console.error(`Geocoding failed for ${restaurant.name}: ${status}`);
                }
            });
        });
    });
}