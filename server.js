const io = require('socket.io')(6000);

io.on('connection',function (socket){
    console.log('New connection')
});