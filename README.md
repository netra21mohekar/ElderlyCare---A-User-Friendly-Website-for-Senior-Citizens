## Build & Push Image

```bash
docker build -t netranetra/elderlycare-web:latest .
docker push netranetra/elderlycare-web:latest
Install via Helm
bash
Copy
Edit
helm install elder-care helm/elderlycare-web \
  --namespace dev-elder-care --create-namespace
Check Deployment
bash
Copy
Edit
kubectl get pods -n dev-elder-care
kubectl get svc -n dev-elder-care
kotlin
Copy
Edit

If you replace your current section with this, the GitHub preview will look professional and clean.  

Do you want me to reformat your **entire README** in this style so the whole thing is consistent?
