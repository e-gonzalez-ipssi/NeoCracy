FROM node

ENV APP_ROOT=/usr/src/app/
ENV PATH=/usr/src/app/node_modules/.bin:$PATH

RUN mkdir ${APP_ROOT}
WORKDIR ${APP_ROOT}

COPY package*.json ${APP_ROOT}

RUN npm install

# ADD . ${APP_ROOT}

# RUN npm run build
EXPOSE 3000
# ENTRYPOINT [ "npm", "run", "start" ]
ENTRYPOINT [ "npm", "run", "dev" ]
