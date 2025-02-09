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
                        //alert(`Inventory for ${restaurant.name}: \n` + inventory.map(item => `${item.item_name}: ${item.quantity}`).join("\n"));
                        const inventoryList = inventory.map(item => `<li>${item.item_name}: ${item.quantity}</li>`).join("");

                        const contentString = `
                            <div style="max-width: 200px;">
                                <h3>${restaurant.name}</h3>
                                <ul>${inventoryList || "<li>No inventory available</li>"}</ul>
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