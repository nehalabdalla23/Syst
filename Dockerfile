FROM python:3.11

WORKDIR /app

COPY hello.py /app/

RUN pip install --no-cache-dir flask==3.0.*

CMD ["python3", "hello.py"]
