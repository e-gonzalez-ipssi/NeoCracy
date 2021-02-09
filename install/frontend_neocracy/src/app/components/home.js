import React from 'react';
import logo from "../../../src/resources/img/logo.svg"
import header from "../../../src/resources/img/header.svg"
import footer from "../../../src/resources/img/footer.svg"
import header2 from "../../../src/resources/img/header2.svg"
import { Link } from 'react-router-dom';

const Home = () => (

<div>

  <div class="bg-grey">

    <img class="z-10 absolute" src={header} alt="header"></img>

    <img class="z-10 absolute w-48 ml-30 mt-10" src={logo} alt="logo"></img>

    <div class="w-A m-auto">

    <div class="flex justify-around align-center">

    <button type="submit" class="z-20 w-B border-transparent bg-black hover:bg-yellow text-white font-bold py-2 px-4 rounded">Inscription</button>

    <button type="submit" class="z-20 w-B border-transparent bg-yellow hover:bg-black text-white font-bold py-2 px-4 rounded">Connexion</button>
    
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
