const estadosData = {
  'aguascalientes': {
    nombre: 'Aguascalientes',
    estaciones: '553+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/aguascalientes.csv',
    coordinates: [-102.2916, 21.8853]
  },
  'baja-california': {
    nombre: 'Baja California',
    estaciones: '1,945+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/baja_california_norte.csv',
    coordinates: [-116.6234, 30.8406]
  },
  'baja-california-sur': {
    nombre: 'Baja California Sur',
    estaciones: '612+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/baja_california_sur.csv',
    coordinates: [-111.6671, 26.0444]
  },
  'campeche': {
    nombre: 'Campeche',
    estaciones: '321+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/campeche.csv',
    coordinates: [-90.5349, 19.8301]
  },
  'chiapas': {
    nombre: 'Chiapas',
    estaciones: '1,240+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/chiapas.csv',
    coordinates: [-92.6376, 16.7569]
  },
  'chihuahua': {
    nombre: 'Chihuahua',
    estaciones: '1,918+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/chihuahua.csv',
    coordinates: [-106.0691, 28.633]
  },
  'cdmx': {
    nombre: 'Ciudad de México',
    estaciones: '1,789+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/ciudad_de_mexico.csv',
    coordinates: [-99.1332, 19.4326]
  },
  'coahuila': {
    nombre: 'Coahuila',
    estaciones: '1,372+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/coahuila.csv',
    coordinates: [-101.7068, 27.0587]
  },
  'colima': {
    nombre: 'Colima',
    estaciones: '372+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/colima.csv',
    coordinates: [-103.724, 19.2452]
  },
  'durango': {
    nombre: 'Durango',
    estaciones: '609+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/durango.csv',
    coordinates: [-104.6532, 24.0277]
  },
  'guanajuato': {
    nombre: 'Guanajuato',
    estaciones: '1,798+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/guanajuato.csv',
    coordinates: [-101.2574, 21.019]
  },
  'guerrero': {
    nombre: 'Guerrero',
    estaciones: '604+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/guerrero.csv',
    coordinates: [-99.5451, 17.4392]
  },
  'hidalgo': {
    nombre: 'Hidalgo',
    estaciones: '1,104+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/hidalgo.csv',
    coordinates: [-98.7624, 20.0911]
  },
  'jalisco': {
    nombre: 'Jalisco',
    estaciones: '3,029+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/jalisco.csv',
    coordinates: [-103.3494, 20.6595]
  },
  'mexico': {
    nombre: 'Estado de México',
    estaciones: '5,292+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/mexico.csv',
    coordinates: [-99.6713, 19.2832]
  },
  'michoacan': {
    nombre: 'Michoacán',
    estaciones: '1,665+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/michoacan.csv',
    coordinates: [-101.7068, 19.5666]
  },
  'morelos': {
    nombre: 'Morelos',
    estaciones: '677+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/morelos.csv',
    coordinates: [-99.2233, 18.6813]
  },
  'nayarit': {
    nombre: 'Nayarit',
    estaciones: '376+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/nayarit.csv',
    coordinates: [-104.8936, 21.7514]
  },
  'nuevo-leon': {
    nombre: 'Nuevo León',
    estaciones: '2,025+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/nuevo_leon.csv',
    coordinates: [-100.3161, 25.5922]
  },
  'oaxaca': {
    nombre: 'Oaxaca',
    estaciones: '738+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/oaxaca.csv',
    coordinates: [-96.7266, 17.0732]
  },
  'puebla': {
    nombre: 'Puebla',
    estaciones: '1,692+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/puebla.csv',
    coordinates: [-98.2063, 19.0414]
  },
  'queretaro': {
    nombre: 'Querétaro',
    estaciones: '1,287+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/queretaro.csv',
    coordinates: [-100.3899, 20.5888]
  },
  'quintana-roo': {
    nombre: 'Quintana Roo',
    estaciones: '525+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/quintana_roo.csv',
    coordinates: [-88.2963, 19.1817]
  },
  'san-luis-potosi': {
    nombre: 'San Luis Potosí',
    estaciones: '756+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/san_luis_potosi.csv',
    coordinates: [-100.9855, 22.1565]
  },
  'sinaloa': {
    nombre: 'Sinaloa',
    estaciones: '1,696+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/sinaloa.csv',
    coordinates: [-107.394, 25.8243]
  },
  'sonora': {
    nombre: 'Sonora',
    estaciones: '1,966+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/sonora.csv',
    coordinates: [-110.9559, 29.2972]
  },
  'tabasco': {
    nombre: 'Tabasco',
    estaciones: '669+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/tabasco.csv',
    coordinates: [-92.9475, 17.8409]
  },
  'tamaulipas': {
    nombre: 'Tamaulipas',
    estaciones: '1,515+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/tamaulipas.csv',
    coordinates: [-99.1013, 24.2669]
  },
  'tlaxcala': {
    nombre: 'Tlaxcala',
    estaciones: '483+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/tlaxcala.csv',
    coordinates: [-98.2375, 19.3139]
  },
  'veracruz': {
    nombre: 'Veracruz',
    estaciones: '2,099+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/veracruz.csv',
    coordinates: [-96.1342, 19.1738]
  },
  'yucatan': {
    nombre: 'Yucatán',
    estaciones: '697+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/yucatan.csv',
    coordinates: [-89.5926, 20.7099]
  },
  'zacatecas': {
    nombre: 'Zacatecas',
    estaciones: '570+',
    descripcion: 'Red completa de estaciones en el estado',
    url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/zacatecas.csv',
    coordinates: [-102.5832, 22.7709]
  },
};