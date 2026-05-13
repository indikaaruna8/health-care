# Health Care - Local SSL Certificate Setup

This guide explains how to install `mkcert` and generate local SSL certificates for the `health-care` project.

## Install mkcert

Run the following commands:

```bash
wget -O mkcert "https://dl.filippo.io/mkcert/latest?for=linux/amd64" && \
chmod +x mkcert && \
sudo mv mkcert /usr/local/bin/ && \
mkcert --version
```

---

# Generate Local Certificates

## Step 1 - Go to Certificates Directory

```bash
cd /<project>/health-care/configs/certs
```

---

## Step 2 - Generate Certificate Files

Run:

```bash
mkcert -key-file localhost-key.pem -cert-file localhost.pem localhost 127.0.0.1 ::1
```

This will generate:

- `localhost.pem`
- `localhost-key.pem`

---

## Step 3 - Set File Permissions

```bash
chmod 644 localhost.pem
chmod 600 localhost-key.pem
```

---

## Step 4 - Install Local CA

Run:

```bash
mkcert install
```

This installs the local Certificate Authority (CA) into your system trust store.

---

# Generated Files

| File | Description |
|---|---|
| `localhost.pem` | SSL certificate |
| `localhost-key.pem` | Private key |

---

# Notes

- These certificates are intended for **local development only**.
- Do not use these certificates in production environments.
- If browsers still show certificate warnings, restart the browser after running `mkcert install`.
