// See https://github.com/dialogflow/dialogflow-fulfillment-nodejs
// for Dialogflow fulfillment library docs, samples, and to report issues
<?php
'use strict';


<script src="https://www.gstatic.com/firebasejs/5.9.2/firebase.js"></script>
<script>
 // Initialize Firebase
 var config = {
   apiKey: "AIzaSyAxbQm5nrXZpSdc3vur04uBQsJ-AwqKNFk",
   authDomain: "ginraibot.firebaseapp.com",
   databaseURL: "https://ginraibot.firebaseio.com",
   projectId: "ginraibot",
   storageBucket: "ginraibot.appspot.com",
   messagingSenderId: "1046614278689"
 };
 firebase.initializeApp(config);
</script>


const functions = require('firebase-functions');
const {WebhookClient} = require('dialogflow-fulfillment');
//const {Card, Suggestion} = require('dialogflow-fulfillment');

const admin = require('firebase-admin');
admin.initializeApp(
//   {
//   credential: admin.credential.applicationDefault(),
//  databaseURL: 'https://ginraibot.firebaseio.com/'
// }
);

process.env.DEBUG = 'dialogflow:debug'; // enables lib debugging statements

exports.dialogflowFirebaseFulfillment = functions.https.onRequest((request, response) => {
  const agent = new WebhookClient({ request, response });
  console.log('Dialogflow Request headers: ' + JSON.stringify(request.headers));
  console.log('Dialogflow Request body: ' + JSON.stringify(request.body));

  function orr(agent){
  const nameParam = agent.parameters.namee;
   const nameParam2 = agent.parameters.namee2;
   // const nameParam3 = agent.parameters.namee2;

  const name = nameParam;
    const name2 = nameParam2;
    //const name3 = nameParam3;

    agent.add('รายการที่สั่งคือ'+name+name2 || name2+name +'ค่ะ');

    return admin.database().ref('/names').push({name: name+name2 || name2+name }).then((snapshot) =>{
      console.log('database write sucessful:' +snapshot.ref.toString());
  }
  );
  }




  function fallback(agent) {
    agent.add(`I didn't understand`);
    agent.add(`I'm sorry, can you try again?`);
  }

  let intentMap = new Map();
  intentMap.set('Order',orr);

  agent.handleRequest(intentMap);
});
?>
