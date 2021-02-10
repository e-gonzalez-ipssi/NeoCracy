import React from 'react';
import logo from "../../../src/resources/img/logos.svg"
import header from "../../../src/resources/img/header.svg"
import footer from "../../../src/resources/img/footer.svg"
import header2 from "../../../src/resources/img/header2.svg"
import { Link } from 'react-router-dom';

const Home = () => (

<div>

  <div class="bg-grey">

    <img class="z-10 absolute" src={header} alt="header"></img>

    <img class="z-10 absolute w-48 ml-30 mt-10" src={logo} alt="logo"></img>

    <div class="z-20 absolute w-full flex items-center h-screen justify-center">

    <div class="flex justify-between">

    <button type="submit" class="z-20 w-90 m-6 text-black shadow bg-yellow py-4 px-4 rounded-xl">Connexion</button>
    
    <button type="submit" class="z-20 w-90 m-6 text-grey shadow bg-black py-4 px-4 rounded-xl">Inscription</button>
    
    </div>
    
    </div>
      
    <img class="z-10 relative"  src={footer} alt="footer"></img>

    </div>

    <div class="z-0 bg-yellow">

      <img class="z-30 relative" src={header2} alt="header2"></img>

    </div>
      
  </div>

  
);

export default Home;
