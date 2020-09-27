FROM node:12.2.0-alpine
WORKDIR /front
ENV PATH /front/node_modules/.bin:$PATH
COPY package.json /front/package.json
RUN npm install
CMD ["npm", "run", "serve"]
