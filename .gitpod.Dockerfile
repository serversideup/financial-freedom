FROM gitpod/workspace-full:latest

ENV SPIN_ENV="dev,gitpod"

RUN echo "alias spin='[ -f node_modules/.bin/spin ] && bash node_modules/.bin/spin || bash vendor/bin/spin'" >> ~/.bashrc