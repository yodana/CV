var http = require('http');
var fs = require('fs');

// Chargement du fichier index.html affiché au client
var server = http.createServer(function(req, res) {
    fs.readFile('./index.html', 'utf-8', function(error, content) {
        res.writeHead(200, {"Content-Type": "text/html"});
        res.end(content);
    });
});

// Chargement de socket.io
var io = require('socket.io').listen(server);

io.sockets.on('connection', function (socket) {
    socket.on('petit_nouveau', function (pseudo){
        socket.pseudo = pseudo;
        socket.broadcast.emit('petit_nouveau', pseudo);
    });
    socket.on('message', function (message) {
        socket.broadcast.emit('message', {pseudo:socket.pseudo,message:message});
    });
});

server.listen(8080);