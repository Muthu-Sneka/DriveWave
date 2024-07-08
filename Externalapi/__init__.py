import requests
import json

def list_cities_in_india():
    base_url = "http://api.geonames.org/searchJSON"
    params = {
        "country": "IN",
        "featureClass": "P",
        "maxRows": 10,
        "username": "derivewave"  
    }
    response = requests.get(base_url, params=params)
    if response.status_code == 200:
        data = response.json()
        cities=[]
        for city in data.get("geonames", []):
            cities.append(city.get("name"))
        return cities
    else:
        print(response)
        
        
def get_lat_lon(city):
    base_url = "https://nominatim.openstreetmap.org/search"
    params = {
        "q": city,
        "format": "json"
    }
    response = requests.get(base_url, params=params)
    data = response.json()
    if data:
        return float(data[0]['lat']), float(data[0]['lon'])
    else:
        return None, None

def get_place(city_name,lat,long):
    
    latitude, longitude = get_lat_lon(city_name)
    if latitude is not None and longitude is not None:
        url = "https://api.foursquare.com/v3/places/search?fields=location"


        params = {
            "query": ".",
            "ll": f"{latitude},{longitude}",
            "open_now": "true",
            "sort":"DISTANCE"
        }

        headers = {
            "Accept": "application/json",
            "Authorization": "fsq3p3luPWi0VhyF2iCplYqfpbkkVQazLEVcCay1L0o6Q9s="
        }

        data = requests.request("GET", url, params=params, headers=headers)
        data_dict = json.loads(data.text)
        response = [result['location']['formatted_address'] for result in data_dict['results']]
        return response

    else:
        print(f"Could not find the latitude and longitude for {city_name}")