import React, { useEffect, useState, useLayoutEffect, useRef } from 'react';
import './App.css';

export const BRNDApp = () => {

  const [statePage, setPageData] = useState(false);
  const { logo, data, menu, header, footer } = statePage;  
  const imageRef = useRef([]);

  useEffect( () => {

    const fetchData = async() => {
        
        await fetch('http://localhost/tests/wordpress/wp-json/custom/v2/home-page', {
          method: 'GET',
          headers:{ 'Content-Type': 'application/json' }
        }).then(response => response.json())
          .then(data => {
            setPageData(data);
          }).catch( e => {
            console.log(e);
          }); 
      }

      fetchData();
  }, []);
  
 useLayoutEffect(() => {
  window.onscroll = () => {
    const { scrollY: scrollPosition } = window;
    imageRef.current.map( (item, index) => {

      let value = 0;

      switch (index) {

        case 0:
          value = 2;
          break;
        
        case 1:
          value = 4;
          break;
        
        case 2:
          value = 6;
          break;

        case 3:
          value = 8;
          break;
        
        case 4:
          value = 7;
          break;

        case 5:
          value = 7.6;
          break;
      
        default:
          value = 0;
          break;
      }
      return item.style.transform = `translate(${0}, -${scrollPosition/value}%)`
    });
  };
}, []);

  return (
    <>
      <div id="page" className="site">
        <header className="headerWrapper">
          <section className="topBarSection">
            <div className="brandData">
              {header?.map((item, index) => (
                <p key={index}>{item.text}</p>
              ))}
            </div>
            <nav className="navWrapper">
              <div className="menu-main-menu-container">
                <ul id="primary-menu" className="menu">
                  {menu?.map((item, index) => (
                    <li key={index} className="">
                      <a href="http://localhost/tests/wordpress/" aria-current="page">{item.title}</a>
                    </li>
                  ))}
                </ul>
              </div>
            </nav>
          </section>
          <section className="brandLogo">
            <a href="/" className="custom-logo-link" rel="home" aria-current="page">
              <img src={ logo?.url } className="custom-logo" alt="BRND." />
            </a>
          </section>
        </header>
        <main id="primary" className="site-main">
          <section className="contents">
            <div className="imgsParallax">
            {data?.acf.map((item, index) => (
              <div className={`m${index}`} key={index} ref={e => imageRef.current[index] = e}>
                <img src={item.image} alt={item.title} />
              </div>
            ))}
            </div>
          </section>
        </main>
        <footer id="colophon" className="site-footer">
          <div className="columns">
            <a href={`http://instagram.com/_u/${footer?.instagram}/`} target="_blank" rel="noreferrer">
              <p className="mx">{footer?.instagram}</p>
            </a>
            <ul className="mx">
              {footer?.phones?.map( (item, index) => (
                <li key={index}>
                  <span className="mr">{item.languague}</span>
                  <a href={`tel:${item.number}`} rel="noreferrer">
                    <span>{item.number}</span>
                  </a>
                </li>
              ))}
            </ul>
          </div>
          <div className="columns">
            <a href={`mailto:${footer?.email}?Subject=Aquí%20el%20asunto%20del%20mail`} target="_blank" rel="noreferrer">
              <p className="mx">{footer?.email}</p>
            </a>
            <p className="mx">{footer?.country}</p>
            <p className="mx">{footer?.terms}</p>
          </div>
        </footer>
      </div>
    </>
  )
}

export default BRNDApp;
