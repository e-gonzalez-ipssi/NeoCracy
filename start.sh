#/bin/bash
DIR="${PWD}"
if [ "$(expr substr $(uname -s) 1 10)" == "MINGW64_NT" ]; then

    echo "vous uttilisez windows"
    echo "version: \"3.6\"
services:
  neocracy-db:
    container_name: neocracy-db
    build:
      context: ../divers/install/database
      dockerfile: Dockerfile
    restart: unless-stopped
    ports:
      - 3307:3306
    volumes:
      - ./database:/var/lib/mysql
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: neocracydb
      MYSQL_USER: user
      MYSQL_PASSWORD: neocracy
    networks:
      - neocracy

  neocracy-myadmin:
    container_name: neocracy-myadmin
    image: phpmyadmin
    restart: always
    depends_on:
      - neocracy-db
    links:
      - neocracy-db
    ports:
      - 8081:80
    environment:
      PMA_HOST: neocracy-db
      MYSQL_ROOT_PASSWORD: root
    networks:
      - neocracy

  portainer:
    container_name: portainer
    image: portainer/portainer-ce:2.1.1
    restart: unless-stopped
    command: -H unix:///var/run/docker.sock
    ports:
      - 9000:9000
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
      - ./portainer:/data
    networks:
      - neocracy

  neocracy-backend:
    container_name: neocracy-backend
    build:
      context: ../backend
      dockerfile: Dockerfile
    image: neocracy-backend
    restart: unless-stopped
    command: php -S 0.0.0.0:8000 -t ./public
    volumes:
      - ../backend:/app
    ports:
      - 8000:8000
    networks:
      - neocracy
    depends_on:
      - neocracy-db
    links:
      - neocracy-db

networks:
  neocracy:
    name: neocracy"  > $DIR/docker/docker-compose.yml
    cd docker
    docker-compose up -d
    cd ..
    cd frontend
    [ -d "node_modules" ] && npm install nuxt
    npm run dev
else
    echo "vous n'uttilisez pas windows"
    echo 'version: "3.6"
services:
  neocracy-db:
    container_name: neocracy-db
    build:
      context: ../divers/install/database
      dockerfile: Dockerfile
    restart: unless-stopped
    ports:
      - 3307:3306
    volumes:
      - ./database:/var/lib/mysql
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: neocracydb
      MYSQL_USER: user
      MYSQL_PASSWORD: neocracy
    networks:
      - neocracy

  neocracy-myadmin:
    container_name: neocracy-myadmin
    image: phpmyadmin
    restart: always
    depends_on:
      - neocracy-db
    links:
      - neocracy-db
    ports:
      - 8081:80
    environment:
      PMA_HOST: neocracy-db
      MYSQL_ROOT_PASSWORD: root
    networks:
      - neocracy

  portainer:
    container_name: portainer
    image: portainer/portainer-ce:2.1.1
    restart: unless-stopped
    command: -H unix:///var/run/docker.sock
    ports:
      - 9000:9000
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
      - ./portainer:/data
    networks:
      - neocracy

  neocracy-backend:
    container_name: neocracy-backend
    build:
      context: ../backend
      dockerfile: Dockerfile
    image: neocracy-backend
    restart: unless-stopped
    command: php -S 0.0.0.0:8000 -t ./public
    volumes:
      - ../backend:/app
    ports:
      - 8000:8000
    networks:
      - neocracy
    depends_on:
      - neocracy-db
    links:
      - neocracy-db

  neocracy-front:
    container_name: neocracy-front
    build:
      context: ../frontend
      dockerfile: Dockerfile
    image: neocracy-front
    restart: unless-stopped
    ports:
      - 3333:3333
    environment:
      HOST: 0.0.0.0
    depends_on:
      - neocracy-db
      - neocracy-backend
    links:
      - neocracy-backend
    volumes:
      - ../frontend:/usr/src/app/
    networks:
      - neocracy

networks:
  neocracy:
    name: neocracy'  > $DIR/docker/docker-compose.yml
    cd docker
    docker-compose up -d
    cd ..
	cd frontend
    [ -d "node_modules" ] && npm install nuxt
fi

