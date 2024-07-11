import * as THREE from "https://cdn.skypack.dev/three@0.129.0/build/three.module.js";
import { OrbitControls } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/controls/OrbitControls.js";
import { GLTFLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js";
import { RGBELoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/RGBELoader.js";

// Variables modificables
const cameraDistance = 10; // Distancia inicial de la cámara
const lightIntensity1 = 2; // Intensidad de la primera luz direccional
const lightIntensity2 = 0.5; // Intensidad de la segunda luz direccional
const lightColor1 = 0xfff6a6; // Color de la primera luz direccional (en formato hexadecimal)
const lightColor2 = 0xa1b1ff; // Color de la segunda luz direccional (en formato hexadecimal)
const ambientLightIntensity = 0.5; // Intensidad de la luz ambiental (0 = apagada, 1 = máxima intensidad)
const hdriPath = "../../Recursos/productos/assets/Studio.hdr"; // Ruta del archivo HDRI
//const modelPath = ""; // Ruta del modelo 3D. (Ahora se define en cada php del producto)
const modelRotation = new THREE.Vector3(0, 0, 0); // Dirección de rotación inicial del modelo 3D
const showHdriBackground = false; // Mostrar el fondo HDRI
const backgroundColor = 0x1E1E1E; // Color de fondo (en formato hexadecimal)
const backgroundTransparent = true; // Fondo transparente

let renderer = null; // Variable global para el renderer
let scene = null;
let camera = null;

export function loadModel3D() {
  const container = document.getElementById('container3D');

  if (!renderer) {
    scene = new THREE.Scene();

    // Cámara
    const aspect = container.offsetWidth / container.offsetHeight;
    camera = new THREE.PerspectiveCamera(75, aspect, 0.1, 1000);
    camera.position.set(0, 0, cameraDistance);

    // Renderizador
    renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(container.offsetWidth, container.offsetHeight);
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1;
    renderer.outputEncoding = THREE.sRGBEncoding;
    container.appendChild(renderer.domElement);

    // Luz direccional
    const topLight = new THREE.DirectionalLight(lightColor1, lightIntensity1);
    topLight.position.set(500, 500, 500);
    topLight.castShadow = true;
    scene.add(topLight);

    // Luz direccional desde el otro lado
    const backLight = new THREE.DirectionalLight(lightColor2, lightIntensity2);
    backLight.position.set(-500, -500, -500);
    scene.add(backLight);

    // Luz ambiental
    const ambientLight = new THREE.AmbientLight(0xffffff, ambientLightIntensity);
    scene.add(ambientLight);

    // Carga del entorno HDRI
    const rgbeLoader = new RGBELoader();
    rgbeLoader.load(hdriPath, function(texture) {
      texture.mapping = THREE.EquirectangularReflectionMapping;
      scene.environment = texture;
      if (showHdriBackground) {
        scene.background = texture;
      } else if (backgroundTransparent) {
        scene.background = null;
        renderer.setClearAlpha(0);
      } else {
        scene.background = new THREE.Color(backgroundColor);
      }
    });

    // Carga del modelo 3D
    const loader = new GLTFLoader();
    loader.load(
      modelPath,
      function (gltf) {
        const object = gltf.scene;
        object.rotation.set(modelRotation.x, modelRotation.y, modelRotation.z); // Aplica la rotación inicial del modelo
        scene.add(object);

        // Asegura que los controles de órbita apunten al centro del modelo
        controls.target.copy(object.position);
      },
      undefined,
      function (error) {
        console.error(error);
      }
    );

    // Controles de órbita
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.25;
    controls.screenSpacePanning = false;
    controls.maxPolarAngle = Math.PI/2.3; // Limita la rotación vertical de la cámara

    // Función de animación
    function animate() {
      requestAnimationFrame(animate);
      controls.update();
      renderer.render(scene, camera);
    }

    // Función para ajustar el tamaño de la ventana
    function onWindowResize() {
      camera.aspect = container.offsetWidth / container.offsetHeight;
      camera.updateProjectionMatrix();
      renderer.setSize(container.offsetWidth, container.offsetHeight);
      //console.log("Se cargo la funcion de loadModel3D");
    }

    // Evento de redimensionamiento del contenedor
    window.addEventListener('resize', onWindowResize, false);

    // Iniciar la animación
    animate();
    //renderer.domElement.style.border = "1px solid red";
  }
}
