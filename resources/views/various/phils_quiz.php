<!DOCTYPE html>
<html style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/buefy/dist/buefy.min.css">
</head>

<body style="background-color: #ddd; padding-top: 30px; padding-bottom: 40px; min-height: 100%;">
    <div id="app" >
      <div class="container card" style="max-width: 750px; padding: 30px; background-color: #fff; border-radius: 5px;">
        <h1 class="title is-4 has-text-centered">CTC proudly presents</h1>
        <h1 class="title is-1 has-text-centered">Phil's Almost 100% easy CTC Stay-at-home Film Quiz</h1>
        <!-- <div class="card" style="margin: 30px;">
          <div class="card-image">
            <figure>
              <img src="https://i2.wp.com/www.nationalreview.com/wp-content/uploads/2018/11/third-man-orson-welles.jpg?fit=1200%2C700&ssl=1" alt="Placeholder image">
            </figure>
          </div>
          <div class="card-content">
            <div class="media">
              <div class="media-content">
                <p class="title is-4">Question 1</p>
              </div>
            </div>

            <div class="content">
              <p class="is-size-5">Orson Welles played Harry Lime in what film from 1949?</p> 
              <p class="is-size-6">Film clip (and answer) on YouTube <a href="https://www.youtube.com/watch?v=U1LTnOvPiZQ" target="_blank">here.</a></p> 
            </div>
          </div>
        </div> -->
        <div class="card" style="margin: 30px;" v-for="question in questions">
          <div class="card-image">
            <figure>
              <img :src="question.imgLink" alt="Placeholder image">
            </figure>
          </div>
          <div class="card-content">
            <div class="media">
              <div class="media-content">
                <p class="title is-4">Question {{question.number}}</p>
              </div>
            </div>

            <div class="content">
              <p class="is-size-5">{{question.question}}</p> 
              <p class="is-size-6">Film clip (and answer) on YouTube <a :href="question.filmLink" target="_blank">here.</a> {{question.answerText}}</p> 
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/buefy/dist/buefy.min.js"></script>

    <script>
        new Vue({
            el: '#app', 
            data() {
              return {
                questions: [
                  {
                    number: 1,
                    question: "Orson Welles played Harry Lime in what film from 1949?",
                    imgLink: "https://i2.wp.com/www.nationalreview.com/wp-content/uploads/2018/11/third-man-orson-welles.jpg?fit=1200%2C700&ssl=1",
                    filmLink: "https://www.youtube.com/watch?v=U1LTnOvPiZQ"
                  },
                  {
                    number: 2,
                    question: "What is the title of the first Indiana Jones film?",
                    imgLink: "https://cdn1us.denofgeek.com/sites/denofgeekus/files/2016/06/raiders-of-the-lost-ark-legacy.jpg",
                    filmLink: "https://www.youtube.com/watch?v=c6XHLe94SJA"
                  },
                  {
                    number: 3,
                    question: "The song “Make ‘em Laugh” is from which film?",
                    imgLink: "http://www.longpauses.com/wp-content/uploads/2012/07/make-em-laugh.jpg",
                    filmLink: "https://www.youtube.com/watch?v=SND3v0i9uhE"
                  },
                  {
                    number: 4,
                    question: "Name the film that had the villain named Keyser Söze.",
                    imgLink: "https://methodshop.com/wp-content/uploads/keyser-soze.jpg",
                    filmLink: "https://www.youtube.com/watch?v=oiXdPolca5w"
                  },
                  {
                    number: 5,
                    question: "What comedy had Milton Berle, Jonathan Winters and other comedians all looking for some money buried \"under a big W\"?",
                    imgLink: "https://3.bp.blogspot.com/-UEsKBJeojDw/U5tIjiVAlBI/AAAAAAAACoc/w2tSbUsS11w/s1600/madrooney1.jpg",
                    filmLink: "https://www.youtube.com/watch?v=j-7pVks8avo",
                    answerText: "(In this clip, they are arguing about who gets what if they find the money.)"
                  },
                  {
                    number: 6,
                    question: "Gregory Peck won an Oscar for what film?",
                    imgLink: "https://cultura.hu/wp-content/uploads/2016/02/gregory-peck-oscar-1963-head.jpg",
                    filmLink: "https://www.youtube.com/watch?v=8MmtVx1A8BA"
                  },
                  {
                    number: 7,
                    question: "Did Kirk Douglas ever win an Oscar?",
                    imgLink: "https://i2-prod.mirror.co.uk/incoming/article9378044.ece/ALTERNATES/s1200/Kirk-Douglas-the-slave-Spartacus.jpg",
                    filmLink: "https://www.youtube.com/watch?v=wBF-0j1IPXw"
                  },
                  {
                    number: 8,
                    question: "Cary Grant was once chased by a small airplane. What was the name of the film?",
                    imgLink: "https://tbrnewsmedia.com/wp-content/uploads/2017/03/north-by-northwest-watching-recommendation-videoSixteenByNine1050.jpg",
                    filmLink: "https://www.youtube.com/watch?v=sIY7BQkbIT8"
                  },
                  {
                    number: 9,
                    question: "Scott Joplin’s music became very popular in 1973, thanks to what film?",
                    imgLink: "https://i.telegraph.co.uk/multimedia/archive/02750/The_Sting_2750386k.jpg",
                    filmLink: "https://www.youtube.com/watch?v=vsFGcPujqKE"
                  },
                  {
                    number: 10,
                    question: "A small bridge has collapsed. If you drive your car fast enough, can you drive the car through the air and get to the other side, of where the bridge used to be? Choose one: Yes, No.",
                    imgLink: "https://i.pinimg.com/736x/ca/60/97/ca6097955ead2af313ae695945406d62--road-trip--road-trips.jpg",
                    filmLink: "https://www.youtube.com/watch?v=xZOg8bzVT5s",
                    answerText: "The clip is from the comedy called “Road Trip.”  (Watch it to the very end.)"
                  }
                ]
              }
            },
        })
    </script>
</body>
</html>