# PROYECTO: AMI WEB & LMS

## 📋 Resumen Ejecutivo
Proyecto de modernización web para AMI (Dr. Frank) y setup de plataforma educativa (LMS Opigno).
- **Repo:** `/home/frank/proyectos/ami_web`
- **Url Web:** `https://lime-lemur-185574.hostingersite.com/`
- **Url LMS:** `https://lime-lemur-185574.hostingersite.com/lms/web/user/login`
- **SSH Command:** `ssh -p 65002 u735651848@194.195.84.173`

### 🚀 Comandos de Despliegue Manual (SSH)
Si `deploy.php` falla, ejecutar en `public_html`:
```bash
git pull origin master
vendor/bin/drush cr
vendor/bin/drush theme:enable ami_medic
vendor/bin/drush config-set system.theme default ami_medic -y
```

### 🔑 Recuperar Acceso (Login Link)
Si olvidas la contraseña, genera un enlace de un solo uso:
```bash
vendor/bin/drush uli
```

## 🎯 Backlog Macro
- [ ] **Fase 1: Identidad Web (Prioridad Alta)**
    - [ ] Setup de Tema `ami_medic` en Drupal 11 (Main Web)
    - [ ] Port de `plantilla-pagina` (HTML -> Drupal Theme)
    - [ ] Configuración de bloques y contenidos base
- [ ] **Fase 2: LMS Opigno**
    - [ ] Configuración inicial
    - [ ] Carga de Curso Piloto
- [ ] **Fase 3: Infraestructura**
    - [ ] Validación de Deploy en Hostinger

##  sprints
### Micro-Sprint 1: Cimientos y Theming
- **Objetivo:** Tener el esqueleto del tema `ami_medic` funcionando en local.
- **Estado:** PLAY
- [ ] Análisis de viabilidad plantilla (COMPLETADO)
- [ ] Creación de estructura de tema (PENDIENTE)

## 📌 Estados
- [ ] Pendiente
- [/] En Progreso
- [x] Completado
