
# FROM Instruction
docker build -t dzulfikrialfik/from 01.from

docker image ls

# RUN Instruction
docker build -t dzulfikrialfik/run 02.run

docker build -t dzulfikrialfik/run 02.run --progress=plain --no-cache

# CMD Instruction
docker build -t dzulfikrialfik/command 03.command

docker image inspect dzulfikrialfik/command

docker container create --name command dzulfikrialfik/command

docker container start command

docker container logs command

# LABEL Instruction
docker build -t dzulfikrialfik/label 04.label

docker image inspect dzulfikrialfik/label

# ADD Instruction
docker build -t dzulfikrialfik/add 05.add

docker container create --name add dzulfikrialfik/add

docker container start add

docker container logs add

# COPY Instruction
docker build -t dzulfikrialfik/copy copy

docker container create --name copy dzulfikrialfik/copy

docker container start copy

docker container logs copy

# .dockerignore
docker build -t dzulfikrialfik/ignore ignore

docker container create --name ignore dzulfikrialfik/ignore

docker container start ignore

docker container logs ignore

# EXPOSE Instruction
docker build -t dzulfikrialfik/expose expose

docker image inspect dzulfikrialfik/expose

docker container create --name expose -p 8080:8080 dzulfikrialfik/expose

docker container start expose

docker container ls

docker container stop expose

# ENV Instruction
docker build -t dzulfikrialfik/env env

docker image inspect dzulfikrialfik/env

docker container create --name env --env APP_PORT=9090 -p 9090:9090 dzulfikrialfik/env

docker container start env

docker container ls

docker container logs env

docker container stop env

# VOLUME Instruction
docker build -t dzulfikrialfik/volume volume

docker image inspect dzulfikrialfik/volume

docker container create --name volume -p 8080:8080 dzulfikrialfik/volume

docker container start volume

docker container logs volume

docker container inspect volume

#15a53c9a60b9aaddb3c294cde03e6f283f319acf0db3e40c5d4b4a992a6451f1

docker volume ls

# WORKDIR Instruction
docker build -t dzulfikrialfik/workdir workdir

docker container create --name workdir -p 8080:8080 dzulfikrialfik/workdir

docker container start workdir

docker container exec -i -t workdir /bin/sh

# USER Instruction
docker build -t dzulfikrialfik/user user

docker container create --name user -p 8080:8080 dzulfikrialfik/user

docker container start user

docker container exec -i -t user /bin/sh

# ARG Instruction
docker build -t dzulfikrialfik/arg arg --build-arg app=pzn

docker container create --name arg -p 8080:8080 dzulfikrialfik/arg

docker container start arg

docker container exec -i -t arg /bin/sh

# HEALTHCHECK Instruction
docker build -t dzulfikrialfik/health health

docker container create --name health -p 8080:8080 dzulfikrialfik/health

docker container start health

docker container ls

docker container inspect health

# ENTRYPOINT Instruction
docker build -t dzulfikrialfik/entrypoint entrypoint

docker image inspect dzulfikrialfik/entrypoint

docker container create --name entrypoint -p 8080:8080 dzulfikrialfik/entrypoint

docker container start entrypoint

# Multi Stage Build
docker build -t dzulfikrialfik/multi multi

docker image ls

docker container create --name multi -p 8080:8080 dzulfikrialfik/multi

docker container start multi

# Docker Push
docker tag dzulfikrialfik/multi registry.digitalocean.com/programmerzamannow/multi

docker --config /Users/dzulfikrialfik/.docker-digital-ocean/ push registry.digitalocean.com/programmerzamannow/multi

docker --config /Users/dzulfikrialfik/.docker-digital-ocean/ pull registry.digitalocean.com/programmerzamannow/multi