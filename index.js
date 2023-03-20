const express = require("express");
const app = express();
const fs = require("fs");
app.listen(3000, () => {
  console.log("Application started and Listening on port 3000");
});
var dateObj = new Date();
var month = dateObj.getUTCMonth() + 1; //months from 1-12
if(month < 10) month = '0'+month;
var year = dateObj.getUTCFullYear();
fileName = year+''+month+".json";

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// fs.readFile("./content.json", "utf8", (err, jsonString) => {
//     if (err) {
//       console.log("File read failed:", err);
//       return;
//     }
//     console.log("File data:", jsonString);
//     let arr = JSON.parse(jsonString);
//     var key1 = new Date().toJSON().slice(0,10).replace(/-/g,'');
//     for(let key in arr){
//         let test = (arr[key]);
        
//     }

//   });

app.get("/", (req, res) => {
    res.sendFile(__dirname + "/index.html");
});

app.get("/list", (req, res) => {
    res.sendFile(__dirname + "/list.html");
});

app.post('/create', function (req, res) {
    var dateObj = new Date();
    var month = dateObj.getUTCMonth() + 1; //months from 1-12
    if(month < 10) month = '0'+month;
    var year = dateObj.getUTCFullYear();
    fileName = year+''+month+".json";



    try {
        if (!fs.existsSync(fileName)) {
            fs.open(fileName, 'w', function (err, file) {
                if (err) throw err;
                console.log('Saved!');
            });
        }
    } catch(err) {
        console.error(err)
    }



    var name = req.body.name;
    var reason = req.body.reason;
    var note = req.body.note;
    fs.readFile(fileName, "utf8", (err, jsonString) => {


        //var key = new Date().toJSON().slice(0,10).replace(/-/g,'');
        let data = { name, reason, note, 'date' : new Date().toLocaleString() };

        var registerList = [];
        if(jsonString == '') {
            registerList.push(data);
        } else {
            registerList = JSON.parse(jsonString);
            registerList.push(data);
        }
        fs.writeFile(fileName, JSON.stringify(registerList), function (err) {
            if (err) throw err;
        });
    });


    

    return res.send('User has been added successfully');
});

app.get('/get_registered_list', function (req, res) {
    var registeredDate = req.query.date;
    //console.log(registeredDate);
    if(registeredDate != '') {
        fileName = registeredDate+'.json';
    }
    // var reason = req.body.reason;
    // let data = { name, reason, 'date' : new Date().toLocaleString()};
    // var content = '';
    fs.readFile(fileName, "utf8", (err, jsonString) => {
        // if (err) {
        //   console.log("File read failed:", err);
        //   return;
        // }
        // content = jsonString;
        let arr = JSON.parse(jsonString);
        return res.send(arr);
        // arr.push(data);
        // fs.writeFile('content.json', JSON.stringify(arr), function (err) {
        //     if (err) throw err;
        // });
    });
    //console.log(content);

    

    
});