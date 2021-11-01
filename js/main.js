const app = Vue.createApp({
    data: function () {
        return {
            message: 'Welcome PHP & Vue.js!!!',
            PlaceA: '0',
            PlaceB: '0',
            format: 'Vue +00.000000,-000.000000',
            
        }
    },
    methods: {

        onSubmit: function () {
            if (this.PlacA === '' || this.PlaceB === '') {
                alert('Podaj współrzędne - pola nie mogą być puste.')
            }
        }
    }


})