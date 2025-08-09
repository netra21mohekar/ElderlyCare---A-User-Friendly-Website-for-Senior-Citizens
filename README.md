### Build & Push Image
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
pgsql
Copy
Edit

That way GitHub will show them as nice code blocks instead of plain text with “bash” written twice.  

Do you want me to rewrite your current README section so it’s perfectly formatted? That way it’ll look professional on GitHub.








Ask ChatGPT
