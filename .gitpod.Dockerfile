FROM gitpod/workspace-base:latest

ENV SPIN_ENV="dev,gitpod"

RUN echo 'export PATH="$HOME/.spin/bin:$PATH"' >> ~/.bashrc && \
    touch /home/gitpod/.bash_profile && \
    chown gitpod:gitpod /home/gitpod/.bash_profile