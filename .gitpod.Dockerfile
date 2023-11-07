FROM gitpod/workspace-base:latest

ENV SPIN_ENV="dev,gitpod"

RUN echo "alias spin='[ -f node_modules/.bin/spin ] && bash node_modules/.bin/spin || bash vendor/bin/spin'" >> ~/.bashrc