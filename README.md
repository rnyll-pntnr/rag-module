# RAG Module for Laravel

A Retrieval-Augmented Generation (RAG) module for Laravel applications that integrates with Google's Gemini AI models to provide document ingestion, embedding generation, and AI-powered question answering capabilities.

## Overview

This module allows you to:
- Upload and ingest documents
- Generate embeddings using Gemini's embedding model
- Store document chunks with vector embeddings
- Ask questions about your documents using RAG techniques

## Installation

### Requirements

- PHP 8.1+
- Laravel 10.x+
- Google Gemini API key

### Steps

1. Add the module to your Laravel project:

```bash
composer require ranyll/rag-module
```

2. Publish the configuration:

```bash
php artisan vendor:publish --tag=rag-config
```

3. Run migrations:

```bash
php artisan migrate
```

4. Add your Gemini API key to your `.env` file:

```
GEMINI_API_KEY=your_api_key_here
```

## Usage

### API Endpoints

The module provides the following API endpoints:

#### Document Upload

```
POST /api/rag/upload
```

Upload and process documents for RAG. Supports PDF, DOCX, and TXT files.

**Request:**
- Form data with `file` parameter containing the document

**Response:**
```json
{
  "success": true,
  "message": "Document uploaded and processed successfully",
  "document_id": 123
}
```

#### Ask Questions

```
POST /api/rag/ask
```

Ask questions about your documents using RAG.

**Request:**
```json
{
  "question": "What is the main topic of the document?"
}
```

**Response:**
```json
{
  "answer": "The document primarily discusses...",
  "sources": [
    {
      "document_id": 123,
      "document_name": "example.pdf",
      "chunk_id": 456
    }
  ]
}
```

#### List Documents

```
GET /api/document
```

Retrieve a list of all uploaded documents.

**Response:**
```json
{
  "documents": [
    {
      "id": 123,
      "name": "example.pdf",
      "created_at": "2023-10-15T14:30:00Z"
    }
  ]
}
```

## License

This module is open-sourced software licensed under the [MIT license](LICENSE).
