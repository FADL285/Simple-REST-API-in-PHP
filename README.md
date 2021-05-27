# Simple-REST-API-in-PHP

Simple REST API with PHP &amp; MySQL

<br />
<br />
<br />

# Guide

- ## Listing all resources

  ```javascript
  fetch('http://localhost/PHP_MySQL_API/api/post/read.php')
    .then((response) => response.json())
    .then((json) => console.log(json));
  ```

- ## Getting a resource

  ```javascript
  fetch('http://localhost/PHP_MySQL_API/api/post/read_single.php?id=100')
    .then((response) => response.json())
    .then((data) => console.log(data));
  ```

- ## Creating a resource

  ```javascript
  fetch('http://localhost/PHP_MySQL_API/api/post/create.php', {
    method: 'POST',
    body: JSON.stringify({
      title: 'This is title',
      body: 'This is body',
      author: 'Mohamed Fadl',
    }),
    headers: {
      'Content-type': 'application/json; charset=UTF-8',
    },
  })
    .then((response) => response.json())
    .then((json) => console.log(json));
  ```

- ## Updating a resource

  ```javascript
  fetch('http://localhost/PHP_MySQL_API/api/post/update.php', {
    method: 'PUT',
    body: JSON.stringify({
      id: 28,
      title: 'this is updated title',
      body: 'this is updated body.',
      author: 'Mohamed Fadl',
    }),
    headers: {
      'Content-type': 'application/json; charset=UTF-8',
    },
  })
    .then((response) => response.json())
    .then((json) => console.log(json));
  ```

- ## Deleting a resource

  ```javascript
  fetch('http://localhost/PHP_MySQL_API/api/post/delete.php', {
    method: 'DELETE',
    body: JSON.stringify({
      id: 27,
    }),
    headers: {
      'Content-type': 'application/json; charset=UTF-8',
    },
  })
    .then((response) => response.json())
    .then((json) => console.log(json));
  ```
