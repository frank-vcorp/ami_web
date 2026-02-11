# 00_ARQUITECTURA: AMI WEB System

## 1. Visión General
El sistema se compone de dos aplicaciones Drupal independientes alojadas en el mismo hosting (Hostinger) pero segregadas por directorios.

### Arquitectura de Despliegue
- **Dominio Principal:** `https://lime-lemur-185574.hostingersite.com/` -> Apunta a `ami_web/web` (Drupal 11)
- **Subdirectorio LMS:** `https://lime.../lms/web` -> Apunta a `ami_web/lms/web` (Opigno / Drupal 10)

## 2. Componentes

### A. Main Website (Drupal 11)
- **Ruta:** `ami_web/web`
- **Core:** Drupal 11.1+
- **Objetivo:** Sitio corporativo/informativo (Reemplazo de medicaindustrial.com)
- **Estrategia Frontend:**
    - **Nuevo Tema Custom:** `ami_medic`
    - **Base:** Starterkit similar a Stable9/Olivero.
    - **Origen de Diseño:** HTML Template Pack `plantilla-pagina` (Requiere port manual de HTML/CSS/JS a Twig/Libraries).

### B. LMS (Opigno)
- **Ruta:** `ami_web/lms`
- **Core:** Opigno LMS ~3.2 (Drupal 10)
- **Objetivo:** Plataforma de capacitación.

## 3. Estrategia de Implementación (Fase 1: Web)

### Theming Process
1.  **Extraction:** Seleccionar el "skin" adecuado de `plantilla-pagina/package` (e.g., `medical` o `skincare`).
2.  **Theme Setup:** Generar `web/themes/custom/ami_medic`.
3.  **Asset Migration:** Mover CSS/JS/Images a `ami_medic/assets`.
4.  **Library Definition:** Crear `ami_medic.libraries.yml` mapeando los assets.
5.  **Twig Integration:**
    - `html.html.twig`: Estructura base.
    - `page.html.twig`: Header, Footer, Regions.
    - `node--*.html.twig`: Diseños específicos de contenido.

## 4. Notas Técnicas
- **Drush:** Disponible v13 para Web, v11/12 para LMS.
- **PHP:** Requiere PHP 8.3 (por Drupal 11).
- **Composer:** Gestión independiente para cada aplicativo.

## 5. Riesgos
- **Compatibilidad PHP:** Drupal 11 requiere versiones muy recientes de PHP. Validar que Hostinger lo soporte para el directorio raíz y que no rompa el LMS (Drupal 10 suele ser compatible con 8.1-8.3, pero hay que verificar).
- **Tiempo de Porting:** Convertir una plantilla HTML completa a Drupal Themes toma tiempo considerable si la plantilla es compleja (muchos JS plugins).
