# 🏗️ Architecture Pattern

## Backend (CodeIgniter)
- **Controllers:** Handle HTTP requests (e.g., `TasksController`).
- **Models:** Data manipulation and business logic (e.g., `TaskModel`).
- **Routes:** Define API endpoints.
- **Database:** Migration to create the `tasks` table.

### Suggested Endpoints
- `GET /tasks` — List tasks
- `POST /tasks` — Create task (optional, extra)
- `PUT /tasks/{id}` — Update task (optional, extra)
- `DELETE /tasks/{id}` — Delete task (optional, extra)

---

## Frontend (Ionic/Angular) — Clean Architecture

- **src/domain/**: Task models and types.
- **src/application/**: Orchestration services (e.g., `TaskService`).
- **src/infrastructure/**: API service implementations.
- **src/presentation/**: UI components (e.g., `TaskListComponent`, `TaskFormComponent`).

### Screens
- **List:** Displays tasks with title, description, and status.
- **Create:** Form to add a new task (optional).
- **UX:** Loading, error feedback, responsive layout.

---

# 📋 Project Progress

- [ ] Backend setup (CodeIgniter + MySQL)
- [ ] Migration for `tasks` table
- [ ] Implement GET /tasks endpoint
- [ ] Implement POST /tasks endpoint (extra)
- [ ] Implement PUT /tasks/{id} endpoint (extra)
- [ ] Implement DELETE /tasks/{id} endpoint (extra)
- [ ] Frontend setup (Ionic/Angular)
- [ ] Create task model (domain)
- [ ] Implement task service (application/infrastructure)
- [ ] Task list screen
- [ ] Task creation screen (extra)
- [ ] Loading and error handling (extra)
- [ ] Documentation and commit organization
- [ ] Use of SASS in frontend (extra)
- [ ] Demo video recording
- [ ] Delivery preparation (README, links, etc.)

---