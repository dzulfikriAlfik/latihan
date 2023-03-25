const fs = require('fs')

const requestHandler = (req, res) => {
  const url = req.url;
  const method = req.method;

  if (url === '/') {
    res.write(`
    <html>
      <head>
        <title>Enter Message</title>
      </head>
      <body>
        <form action="/message" method="POST">
          <input type="text" name="message" />
          <button type="submit">SUBMIT</button>
        </form>
      </body>
    </html>
    `)
    return res.end()
  }
  
  if (url === '/message' && method === 'POST') {
    const body = []
  
    req.on('data', (chunk) => {
      console.log(chunk)
      body.push(chunk)
    })
  
    return req.on('end', () => {
      const parsedBody = Buffer.concat(body).toString()
      const message = parsedBody.split('=')[1]
  
      fs.writeFile('message.txt', message, (error) => {
        res.statusCode = 302
        res.setHeader('Location', '/')
        return res.end()
      })
    })
  }
  
  res.setHeader('Content-Type', 'text/html')
  res.write(`
  <html>
    <head>
      <title>My First page using node js</title>
    </head>
    <body>
      <h1>Test</h1>
      <p>User Agent : ${req.headers['user-agent']}</p>
    </body>
  </html>
  `)
  res.end()
}

// module.exports = requestHandler

// module.exports = {
//   handler: requestHandler
// }

exports.handler = requestHandler