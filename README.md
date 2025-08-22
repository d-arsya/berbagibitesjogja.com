### 1. Clone the repository

```bash
git clone https://github.com/d-arsya/BerbagiBitesJogjaMobileBackend.git bbj-mobile-be
cd bbj-mobile-be
```

### 2. Create environment file

Copy `.env.example` to `.env` and fill in your own values:

```bash
PG_URL=mysql+pymysql:://username:password@host:3306/dbname
SECRET=your_secret_key
ALGORITHM=HS256
```

> ⚠️ Never commit your real `.env` file to Git.

### 3. Run with Docker Compose

Build and start the service in detached mode:

```bash
docker compose up -d --build
```

Or, if you already pushed a new image to Docker Hub and want to update:

```bash
docker compose up -d --pull always
```

### 4. Check logs

```bash
docker compose logs -f backend
```

### 5. Stop the service

```bash
docker compose down
```

---

## 🛠️ Service Details

- **Service Name:** `backend`
- **Image:** `disyfa/bbj-mobile-be`
- **Container Name:** `bbj-mobile-be`
- **Ports:**

  - Host `3000` → Container `8000`

- **Environment Variables:**
  Defined in `.env` file
- **Volumes:**

  - `./uploads` (local) → `/app/uploads` (container)

---

## 🔄 Updating the Service

To update to the latest image from Docker Hub:

```bash
docker compose up -d --pull always
```

This command will:

1. Pull the latest image (`disyfa/bbj-mobile-be`)
2. Recreate the container with the new image
3. Keep it running in the background

## 📄 License

This project is licensed under the MIT License.
