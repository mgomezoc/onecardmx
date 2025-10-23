/**
 * Mapa Interactivo de México con Mapbox GL JS
 * OneCard - Comercios Afiliados Combustible
 * Version: 3.3 - Buscador mejorado e intuitivo
 */

(function () {
    'use strict';

    // Tu token de Mapbox
    mapboxgl.accessToken = 'pk.eyJ1IjoiY2dvbWV6MTMiLCJhIjoiY2l6Y3gwdnRyMjRjcjMycWk4dzE4YXExaiJ9.OwNT5JIsW2Lll39wtqeMGA';

    // Datos de estados con coordenadas centrales
    const estadosData = {
        aguascalientes: {
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
        campeche: {
            nombre: 'Campeche',
            estaciones: '321+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/campeche.csv',
            coordinates: [-90.5349, 19.8301]
        },
        chiapas: {
            nombre: 'Chiapas',
            estaciones: '1,240+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/chiapas.csv',
            coordinates: [-92.6376, 16.7569]
        },
        chihuahua: {
            nombre: 'Chihuahua',
            estaciones: '1,918+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/chihuahua.csv',
            coordinates: [-106.0691, 28.633]
        },
        cdmx: {
            nombre: 'Ciudad de México',
            estaciones: '1,789+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/ciudad_de_mexico.csv',
            coordinates: [-99.1332, 19.4326]
        },
        coahuila: {
            nombre: 'Coahuila',
            estaciones: '1,372+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/coahuila.csv',
            coordinates: [-101.7068, 27.0587]
        },
        colima: {
            nombre: 'Colima',
            estaciones: '372+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/colima.csv',
            coordinates: [-103.724, 19.2452]
        },
        durango: {
            nombre: 'Durango',
            estaciones: '609+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/durango.csv',
            coordinates: [-104.6532, 24.0277]
        },
        guanajuato: {
            nombre: 'Guanajuato',
            estaciones: '1,798+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/guanajuato.csv',
            coordinates: [-101.2574, 21.019]
        },
        guerrero: {
            nombre: 'Guerrero',
            estaciones: '604+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/guerrero.csv',
            coordinates: [-99.5451, 17.4392]
        },
        hidalgo: {
            nombre: 'Hidalgo',
            estaciones: '1,104+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/hidalgo.csv',
            coordinates: [-98.7624, 20.0911]
        },
        jalisco: {
            nombre: 'Jalisco',
            estaciones: '3,029+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/jalisco.csv',
            coordinates: [-103.3494, 20.6595]
        },
        mexico: {
            nombre: 'Estado de México',
            estaciones: '5,292+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/mexico.csv',
            coordinates: [-99.6713, 19.2832]
        },
        michoacan: {
            nombre: 'Michoacán',
            estaciones: '1,665+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/michoacan.csv',
            coordinates: [-101.7068, 19.5666]
        },
        morelos: {
            nombre: 'Morelos',
            estaciones: '677+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/morelos.csv',
            coordinates: [-99.2233, 18.6813]
        },
        nayarit: {
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
        oaxaca: {
            nombre: 'Oaxaca',
            estaciones: '738+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/oaxaca.csv',
            coordinates: [-96.7266, 17.0732]
        },
        puebla: {
            nombre: 'Puebla',
            estaciones: '1,692+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/puebla.csv',
            coordinates: [-98.2063, 19.0414]
        },
        queretaro: {
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
        sinaloa: {
            nombre: 'Sinaloa',
            estaciones: '1,696+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/sinaloa.csv',
            coordinates: [-107.394, 25.8243]
        },
        sonora: {
            nombre: 'Sonora',
            estaciones: '1,966+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/sonora.csv',
            coordinates: [-110.9559, 29.2972]
        },
        tabasco: {
            nombre: 'Tabasco',
            estaciones: '669+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/tabasco.csv',
            coordinates: [-92.9475, 17.8409]
        },
        tamaulipas: {
            nombre: 'Tamaulipas',
            estaciones: '1,515+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/tamaulipas.csv',
            coordinates: [-99.1013, 24.2669]
        },
        tlaxcala: {
            nombre: 'Tlaxcala',
            estaciones: '483+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/tlaxcala.csv',
            coordinates: [-98.2375, 19.3139]
        },
        veracruz: {
            nombre: 'Veracruz',
            estaciones: '2,099+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/veracruz.csv',
            coordinates: [-96.1342, 19.1738]
        },
        yucatan: {
            nombre: 'Yucatán',
            estaciones: '697+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/yucatan.csv',
            coordinates: [-89.5926, 20.7099]
        },
        zacatecas: {
            nombre: 'Zacatecas',
            estaciones: '570+',
            descripcion: 'Red completa de estaciones en el estado',
            url: 'http://onecard.mx/wp-content/themes/adfactory/descargas_estados/zacatecas.csv',
            coordinates: [-102.5832, 22.7709]
        }
    };

    let map;
    let markers = {};

    // Inicializar el mapa con optimizaciones
    function initMap() {
        map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [-102.5528, 23.6345],
            zoom: 4.5,
            minZoom: 4,
            maxZoom: 10,
            antialias: false,
            preserveDrawingBuffer: false,
            refreshExpiredTiles: false,
            pitchWithRotate: false,
            dragRotate: false,
            touchPitch: false,
            maxTileCacheSize: 50,
            fadeDuration: 0,
            crossSourceCollisions: false
        });

        map.boxZoom.disable();

        map.addControl(
            new mapboxgl.NavigationControl({
                showCompass: false
            }),
            'bottom-right'
        );

        map.addControl(new mapboxgl.FullscreenControl(), 'bottom-right');

        map.on('load', function () {
            console.log('Mapa cargado correctamente');
            agregarMarcadores();
            generarBotonesEstados();
            configurarBuscadorMejorado();

            const resetBtn = document.getElementById('resetView');
            if (resetBtn) {
                resetBtn.addEventListener('click', function () {
                    resetearVista();
                });
            }
        });

        map.on('render', function () {
            if (!map.isMoving() && !map.isZooming() && !map.isRotating()) {
                map.stop();
            }
        });
    }

    // Agregar marcadores
    function agregarMarcadores() {
        Object.keys(estadosData).forEach(function (key) {
            const estado = estadosData[key];

            const el = document.createElement('div');
            el.className = 'custom-marker';
            el.innerHTML = `
        <svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
          <circle cx="20" cy="20" r="18" fill="#5d9b3d" stroke="#fff" stroke-width="3"/>
          <g transform="translate(12, 12)">
            <path d="M2,2 L2,12 L10,12 L10,2 Z M4,4 L8,4 L8,10 L4,10 Z M10,4 L12,4 L12,8 L14,8 L14,12 L12,12 L12,10 L10,10 Z" 
                  fill="#fff" stroke="#fff" stroke-width="0.5"/>
          </g>
        </svg>
      `;

            el.style.width = '40px';
            el.style.height = '40px';
            el.style.cursor = 'pointer';

            const popup = new mapboxgl.Popup({
                offset: 25,
                closeButton: true,
                closeOnClick: true,
                anchor: 'bottom',
                maxWidth: '300px',
                className: 'custom-popup'
            }).setHTML(`
        <div style="padding: 15px; text-align: center;">
          <h4 style="margin: 0 0 10px 0; color: #5d9b3d; font-weight: bold; font-size: 18px;">${estado.nombre}</h4>
          <p style="margin: 8px 0; font-size: 15px;">
            <strong>Estaciones:</strong> 
            <span style="color: #5d9b3d; font-weight: bold;">${estado.estaciones}</span>
          </p>
          <p style="margin: 8px 0; font-size: 14px; color: #666;">${estado.descripcion}</p>
          <button onclick="verDetallesEstado('${key}')" 
                  style="background: linear-gradient(135deg, #5d9b3d 0%, #7bc043 100%); 
                         color: white; 
                         border: none; 
                         padding: 10px 20px; 
                         border-radius: 8px; 
                         cursor: pointer; 
                         margin-top: 10px; 
                         width: 100%; 
                         font-size: 15px;
                         font-weight: 600;
                         box-shadow: 0 2px 5px rgba(93, 155, 61, 0.3);">
            <i class="fas fa-info-circle"></i> Ver Detalles
          </button>
        </div>
      `);

            const marker = new mapboxgl.Marker({
                element: el,
                anchor: 'bottom'
            })
                .setLngLat(estado.coordinates)
                .setPopup(popup)
                .addTo(map);

            markers[key] = marker;

            el.addEventListener('click', function (e) {
                e.stopPropagation();
                volarAEstado(key);
            });
        });

        console.log('Marcadores agregados:', Object.keys(markers).length);
    }

    // Volar a un estado específico
    window.volarAEstado = function (estadoKey) {
        const estado = estadosData[estadoKey];

        if (!estado) return;

        Object.values(markers).forEach(function (marker) {
            marker.getPopup().remove();
        });

        map.flyTo({
            center: estado.coordinates,
            zoom: 7,
            speed: 2.5,
            curve: 1,
            easing: function (t) {
                return t;
            },
            essential: true
        });

        mostrarPanel(estado);

        setTimeout(function () {
            const marker = markers[estadoKey];
            if (marker) {
                marker.togglePopup();
            }
        }, 800);
    };

    // Ver detalles del estado
    window.verDetallesEstado = function (estadoKey) {
        const estado = estadosData[estadoKey];
        mostrarPanel(estado);

        const panel = document.getElementById('info-panel-mapbox');
        if (panel) {
            panel.scrollIntoView({
                behavior: 'auto',
                block: 'nearest'
            });
        }
    };

    // Mostrar panel de información
    function mostrarPanel(estado) {
        const panelNombre = document.getElementById('panel-estado-nombre');
        const panelEstaciones = document.getElementById('panel-estaciones');
        const panelDescripcion = document.getElementById('panel-descripcion');
        const panelLink = document.getElementById('panel-download-link');

        if (panelNombre) panelNombre.textContent = estado.nombre;
        if (panelEstaciones) panelEstaciones.textContent = estado.estaciones;
        if (panelDescripcion) panelDescripcion.textContent = estado.descripcion;
        if (panelLink) panelLink.href = estado.url;

        const panel = document.getElementById('info-panel-mapbox');
        if (panel) {
            panel.style.display = 'block';
        }
    }

    // Ocultar panel
    function ocultarPanel() {
        const panel = document.getElementById('info-panel-mapbox');
        if (panel) {
            panel.style.display = 'none';
        }
    }

    // Resetear vista del mapa
    function resetearVista() {
        map.flyTo({
            center: [-102.5528, 23.6345],
            zoom: 4.5,
            speed: 2,
            curve: 1,
            essential: true
        });
        ocultarPanel();

        Object.values(markers).forEach(function (marker) {
            marker.getPopup().remove();
        });
    }

    // Generar botones de estados
    function generarBotonesEstados() {
        const container = document.getElementById('estados-buttons');
        if (!container) return;

        const fragment = document.createDocumentFragment();

        Object.keys(estadosData).forEach(function (key) {
            const estado = estadosData[key];

            const col = document.createElement('div');
            col.className = 'col-lg-3 col-md-4 col-sm-6 mb-3 estado-item';
            col.setAttribute('data-estado-key', key);

            const button = document.createElement('button');
            button.className = 'btn btn-outline-success w-100 estado-btn';
            button.setAttribute('data-estado', key);
            button.style.cssText = 'padding: 12px; border-width: 2px; border-radius: 10px; transition: all 0.3s ease;';
            button.innerHTML = `
        <i class="fas fa-map-marker-alt me-2"></i>
        ${estado.nombre}
        <br>
        <small class="text-muted" style="font-size: 12px;">${estado.estaciones}</small>
      `;

            button.onclick = function () {
                volarAEstado(key);
            };

            col.appendChild(button);
            fragment.appendChild(col);
        });

        container.appendChild(fragment);
    }

    // NUEVO: Configurar buscador mejorado con UI intuitiva
    function configurarBuscadorMejorado() {
        const searchInput = document.getElementById('estadoSearchMapbox');
        if (!searchInput) return;

        // Crear contenedor de sugerencias
        const suggestionsContainer = document.createElement('div');
        suggestionsContainer.id = 'search-suggestions';
        suggestionsContainer.className = 'search-suggestions-dropdown';
        suggestionsContainer.style.cssText = `
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: white;
      border: 2px solid #5d9b3d;
      border-top: none;
      border-radius: 0 0 10px 10px;
      max-height: 300px;
      overflow-y: auto;
      display: none;
      z-index: 1000;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    `;
        searchInput.parentElement.style.position = 'relative';
        searchInput.parentElement.appendChild(suggestionsContainer);

        // Crear contador de resultados
        const resultCounter = document.createElement('div');
        resultCounter.id = 'search-result-counter';
        resultCounter.className = 'search-result-counter';
        resultCounter.style.cssText = `
      margin-top: 10px;
      padding: 10px 15px;
      background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
      border-radius: 8px;
      font-weight: 600;
      color: #2e7d32;
      text-align: center;
      display: none;
      animation: fadeIn 0.3s ease;
    `;
        searchInput.parentElement.appendChild(resultCounter);

        let debounceTimer;
        let currentFocus = -1;

        // Input event con sugerencias
        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const searchTerm = this.value.trim();

            if (searchTerm === '') {
                suggestionsContainer.style.display = 'none';
                resultCounter.style.display = 'none';
                mostrarTodosLosEstados();
                return;
            }

            debounceTimer = setTimeout(function () {
                const results = buscarEstados(searchTerm);
                mostrarSugerencias(results, searchTerm);
                actualizarContador(results.length);
                filtrarBotones(searchTerm);
            }, 150);
        });

        // Focus - mostrar sugerencias si hay texto
        searchInput.addEventListener('focus', function () {
            const searchTerm = this.value.trim();
            if (searchTerm !== '') {
                const results = buscarEstados(searchTerm);
                mostrarSugerencias(results, searchTerm);
            }
        });

        // Click fuera - ocultar sugerencias
        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                suggestionsContainer.style.display = 'none';
            }
        });

        // Navegación con teclado
        searchInput.addEventListener('keydown', function (e) {
            const items = suggestionsContainer.querySelectorAll('.suggestion-item');

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                currentFocus++;
                if (currentFocus >= items.length) currentFocus = 0;
                setActive(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                currentFocus--;
                if (currentFocus < 0) currentFocus = items.length - 1;
                setActive(items);
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (currentFocus > -1 && items[currentFocus]) {
                    items[currentFocus].click();
                } else {
                    const searchTerm = this.value.trim();
                    const results = buscarEstados(searchTerm);
                    if (results.length > 0) {
                        volarAEstado(results[0].key);
                        suggestionsContainer.style.display = 'none';
                    }
                }
            } else if (e.key === 'Escape') {
                suggestionsContainer.style.display = 'none';
                searchInput.blur();
            }
        });

        function setActive(items) {
            items.forEach(function (item, index) {
                if (index === currentFocus) {
                    item.style.background = '#e8f5e9';
                    item.scrollIntoView({ block: 'nearest' });
                } else {
                    item.style.background = 'white';
                }
            });
        }

        // Buscar estados que coincidan
        function buscarEstados(term) {
            const normalizedTerm = term
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '');
            const results = [];

            Object.keys(estadosData).forEach(function (key) {
                const estado = estadosData[key];
                const normalizedNombre = estado.nombre
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '');

                if (normalizedNombre.includes(normalizedTerm)) {
                    results.push({
                        key: key,
                        estado: estado,
                        matchIndex: normalizedNombre.indexOf(normalizedTerm)
                    });
                }
            });

            // Ordenar por relevancia (coincidencias al inicio primero)
            results.sort(function (a, b) {
                return a.matchIndex - b.matchIndex;
            });

            return results;
        }

        // Mostrar sugerencias en dropdown
        function mostrarSugerencias(results, searchTerm) {
            suggestionsContainer.innerHTML = '';
            currentFocus = -1;

            if (results.length === 0) {
                suggestionsContainer.innerHTML = `
          <div style="padding: 15px; text-align: center; color: #999;">
            <i class="fas fa-search" style="font-size: 24px; margin-bottom: 10px;"></i>
            <p style="margin: 0;">No se encontraron estados</p>
          </div>
        `;
                suggestionsContainer.style.display = 'block';
                return;
            }

            results.forEach(function (result) {
                const item = document.createElement('div');
                item.className = 'suggestion-item';
                item.style.cssText = `
          padding: 12px 15px;
          cursor: pointer;
          border-bottom: 1px solid #f0f0f0;
          transition: background 0.2s ease;
          display: flex;
          align-items: center;
          justify-content: space-between;
        `;

                // Resaltar texto coincidente
                const nombre = result.estado.nombre;
                const normalizedNombre = nombre
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '');
                const normalizedTerm = searchTerm
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '');
                const index = normalizedNombre.indexOf(normalizedTerm);

                let displayNombre = nombre;
                if (index !== -1) {
                    const before = nombre.substring(0, index);
                    const match = nombre.substring(index, index + searchTerm.length);
                    const after = nombre.substring(index + searchTerm.length);
                    displayNombre = `${before}<strong style="color: #5d9b3d; background: #e8f5e9; padding: 2px 4px; border-radius: 3px;">${match}</strong>${after}`;
                }

                item.innerHTML = `
          <div>
            <div style="font-weight: 600; font-size: 15px;">
              <i class="fas fa-map-marker-alt" style="color: #5d9b3d; margin-right: 8px;"></i>
              ${displayNombre}
            </div>
            <small style="color: #666; margin-left: 24px;">${result.estado.estaciones} estaciones</small>
          </div>
          <i class="fas fa-arrow-right" style="color: #5d9b3d;"></i>
        `;

                item.addEventListener('mouseenter', function () {
                    this.style.background = '#e8f5e9';
                });

                item.addEventListener('mouseleave', function () {
                    this.style.background = 'white';
                });

                item.addEventListener('click', function () {
                    volarAEstado(result.key);
                    searchInput.value = result.estado.nombre;
                    suggestionsContainer.style.display = 'none';
                });

                suggestionsContainer.appendChild(item);
            });

            suggestionsContainer.style.display = 'block';
        }

        // Actualizar contador de resultados
        function actualizarContador(count) {
            if (count === 0) {
                resultCounter.innerHTML = `
          <i class="fas fa-times-circle me-2"></i>
          No se encontraron estados
        `;
                resultCounter.style.background = 'linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%)';
                resultCounter.style.color = '#c62828';
            } else if (count === 1) {
                resultCounter.innerHTML = `
          <i class="fas fa-check-circle me-2"></i>
          1 estado encontrado
        `;
                resultCounter.style.background = 'linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%)';
                resultCounter.style.color = '#2e7d32';
            } else {
                resultCounter.innerHTML = `
          <i class="fas fa-check-circle me-2"></i>
          ${count} estados encontrados
        `;
                resultCounter.style.background = 'linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%)';
                resultCounter.style.color = '#2e7d32';
            }
            resultCounter.style.display = 'block';
        }

        // Filtrar botones
        function filtrarBotones(searchTerm) {
            const normalizedTerm = searchTerm
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '');
            const items = document.querySelectorAll('.estado-item');

            items.forEach(function (item) {
                const button = item.querySelector('button');
                if (button) {
                    const text = button.textContent
                        .toLowerCase()
                        .normalize('NFD')
                        .replace(/[\u0300-\u036f]/g, '');
                    if (text.includes(normalizedTerm)) {
                        item.style.display = 'block';
                        button.classList.remove('btn-outline-success');
                        button.classList.add('btn-success');
                        // Animación de pulso
                        button.style.animation = 'pulse 1.5s infinite';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        }

        // Mostrar todos los estados
        function mostrarTodosLosEstados() {
            const items = document.querySelectorAll('.estado-item');
            items.forEach(function (item) {
                item.style.display = 'block';
                const button = item.querySelector('button');
                if (button) {
                    button.classList.add('btn-outline-success');
                    button.classList.remove('btn-success');
                    button.style.animation = 'none';
                }
            });
        }
    }

    // Inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMap);
    } else {
        initMap();
    }
})();

// Agregar estilos CSS para animaciones
const style = document.createElement('style');
style.textContent = `
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  
  @keyframes pulse {
    0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(93, 155, 61, 0.7); }
    50% { transform: scale(1.02); box-shadow: 0 0 0 8px rgba(93, 155, 61, 0); }
  }
  
  .search-suggestions-dropdown::-webkit-scrollbar {
    width: 8px;
  }
  
  .search-suggestions-dropdown::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }
  
  .search-suggestions-dropdown::-webkit-scrollbar-thumb {
    background: #5d9b3d;
    border-radius: 10px;
  }
  
  .search-suggestions-dropdown::-webkit-scrollbar-thumb:hover {
    background: #4a7c2f;
  }
`;
document.head.appendChild(style);
