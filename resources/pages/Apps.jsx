import React from 'react'
import { ContextProvider } from './helpers/Context'

import Header from './components/Header'
import Hero from './components/Hero'
import Lomba from './components/Lomba'
// import Olimpiade from "./components/LombaOlimpiade";
// import Infografis from "./components/LombaInfografis";
import Semnas from './components/Semnas'
import Dn from './components/Dn'
import Berita from './components/Berita'
import Timeline from './components/Timeline'
// import CTA from "./components/CTA";
import FAQ from './components/FAQ'
import Galeri from './components/Galeri'
import Footer from './components/Footer'

export default () => {
  return (
    <ContextProvider>
      <Header />
      <Hero />
      <Lomba />
      {/* <Olimpiade /> */}
      {/* <Infografis /> */}
      <Semnas />
      <Dn />
      <Berita />
      <Timeline />
      {/* <CTA /> */}
      <FAQ />
      <Galeri />
      <Footer />
    </ContextProvider>
  )
}
