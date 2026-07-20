FROM cemarin/node-base:20-alpine
ENV CI=true

RUN corepack enable && corepack prepare pnpm@latest --activate

WORKDIR /app

# Copiamos solo el package.json primero para aprovechar el cache de capas de Docker:
# si no cambian las dependencias, esta capa no se reconstruye en cada build.
COPY web/package.json web/pnpm-lock.yaml* ./
RUN pnpm install

# El resto del código NO hace falta copiarlo aquí: en desarrollo se monta como
# bind mount desde docker-compose.yaml (./web:/app), y ese mount sobrescribe
# cualquier archivo copiado en build time. Este COPY solo deja la imagen
# utilizable de forma standalone (ej. si algún día corres el contenedor sin compose).
COPY web/ .

EXPOSE 3001

CMD ["pnpm", "run", "dev", "--", "--host", "0.0.0.0", "--port", "3001"]