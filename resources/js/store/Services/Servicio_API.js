export class Servicio_API{
    constructor(URL){
        this.URL = URL;
    }
    obtenerEstancias() {
        return fetch(this.API_URL + 'estancias')
            .then(function(response) {
                if (response.ok)
                    return response.json()
            })
    }
}