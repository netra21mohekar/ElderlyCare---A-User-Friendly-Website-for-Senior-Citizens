# ElderlyCare – A User-Friendly Website for Senior Citizens

ElderlyCare is a web application designed to help senior citizens easily access useful features and information.  
This repository contains the source code **and** Kubernetes Helm chart for deploying the application.

---

## 📂 Project Structure
ElderCare/
│
├── app/ # Application source code
├── helm/elderlycare-web # Helm chart for Kubernetes deployment
└── Dockerfile # For building Docker image

yaml
Copy
Edit

---

## 🚀 Deployment Options

You can run ElderlyCare either locally with Docker or in Kubernetes with Helm.

---

### 1️⃣ Run Locally (Docker Compose)
```bash
docker-compose up --build
Access the app at: http://localhost:8080

2️⃣ Deploy to Kubernetes with Helm
Prerequisites
Docker

Kubernetes Cluster (Minikube, Kind, EKS, etc.)

Helm

Steps
Clone the repo

bash
Copy
Edit
git clone https://github.com/netra21mohekar/ElderCare.git
cd ElderCare
Push your Docker image (if not already available)

bash
Copy
Edit
docker build -t netranetra/elderlycare-web:latest .
docker push netranetra/elderlycare-web:latest
Install via Helm

bash
Copy
Edit
helm install elder-care helm/elderlycare-web \
  --namespace dev-elder-care --create-namespace
Check deployment

bash
Copy
Edit
kubectl get pods -n dev-elder-care
kubectl get svc -n dev-elder-care
Access the application

If using Minikube:

bash
Copy
Edit
minikube service elder-care-elderlycare-web -n dev-elder-care
Or get the service’s external IP:

bash
Copy
Edit
kubectl get svc -n dev-elder-care
⚙️ Helm Chart Customization
You can modify the deployment by editing helm/elderlycare-web/values.yaml.

Example:

yaml
Copy
Edit
image:
  repository: your-dockerhub-username/elderlycare-web
  tag: latest
service:
  port: 80
