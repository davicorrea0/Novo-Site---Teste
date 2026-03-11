/**
 * @license
 * SPDX-License-Identifier: Apache-2.0
 */

import { useState, useEffect } from "react";
import { AnimatePresence, motion } from "motion/react";
import { Navbar } from "./components/Navbar";
import { Hero } from "./components/Hero";
import { VideoSection } from "./components/VideoSection";
import { About } from "./components/About";
import { Carousel } from "./components/Carousel";
import { Segments } from "./components/Segments";
import { Brands } from "./components/Brands";
import { Location } from "./components/Location";
import { Contact } from "./components/Contact";
import { Footer } from "./components/Footer";
import { Loader } from "./components/Loader";

export default function App() {
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    // Force scroll to top on reload
    window.scrollTo(0, 0);
    
    // Simulate loading time
    const timer = setTimeout(() => {
      setIsLoading(false);
    }, 4500);

    return () => clearTimeout(timer);
  }, []);

  return (
    <div className="min-h-screen bg-secondary font-sans selection:bg-black selection:text-white">
      <AnimatePresence>
        {isLoading && <Loader />}
      </AnimatePresence>
      
      {!isLoading && (
        <>
          <Navbar />
          <motion.main
            initial={{ y: 100 }}
            animate={{ y: 0 }}
            transition={{ duration: 1.2, ease: [0.76, 0, 0.24, 1], delay: 0.4 }}
          >
            <Hero />
            <VideoSection />
            <About />
            <Carousel />
            <Segments />
            <Brands />
            <Location />
            <Contact />
          </motion.main>
        </>
      )}
      
      {!isLoading && (
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ duration: 1, delay: 0.5 }}
        >
          <Footer />
        </motion.div>
      )}
    </div>
  );
}

