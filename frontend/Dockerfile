FROM node

ENV APP_ROOT=/usr/src/app/
ENV PATH=/usr/src/app/node_modules/.bin:$PATH

RUN mkdir ${APP_ROOT}
WORKDIR ${APP_ROOT}

COPY package.json ${APP_ROOT}

RUN npm install
EXPOSE 3333
ADD . ${APP_ROOT}
VOLUME ${APP_ROOT}
RUN npm run build
CMD [ "npm", "start" ]
