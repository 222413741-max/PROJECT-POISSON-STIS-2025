import React, { useContext } from "react";
import styled from "styled-components";
import tw from "twin.macro";
import Context from "../helpers/Context";
import { useTranslation } from "react-i18next";

import { Container as ContainerBase } from "./misc/Layouts";

// import logo from "images/logo.svg";
// import { ReactComponent as InstagramIcon } from "images/instagram.svg";
// import { ReactComponent as TiktokLogo } from "images/tiktok-logo.svg";
// import { ReactComponent as GmailLogo } from "images/gmail-logo.svg";

import { footerBg, logo, transisiFooter } from "../config";
import SvgInstagram from "./svgJSX/Instagram";
import SvgTiktokLogo from "./svgJSX/TiktokLogo";
import SvgGmailLogo from "./svgJSX/GmailLogo";
import SvgYTLogo from "./svgJSX/YoutubeIcon.jsx";
import Log from "laravel-mix/src/Log";

const InstagramIcon = SvgInstagram;
const TiktokLogo = SvgTiktokLogo;
const GmailLogo = SvgGmailLogo;
const YTLogo = SvgYTLogo;

// Styled Component
const Container = tw(ContainerBase)` text-gray-100 p-2 md:px-12 md:py-8`;

const Content = tw.div`relative z-10 mx-auto py-14 lg:py-10 bg-white bg-opacity-75 rounded-3xl`;

const Col = tw.div`flex items-center justify-between flex-col px-8`;

const Row = tw.div`flex items-center justify-between flex-col md:flex-row px-8 w-full gap-4 md:gap-0`;

const LeftContainer = tw.div`flex flex-col items-center md:items-start`;

const RightContainer = tw.div`flex flex-col items-center md:items-end gap-4`;

const CopyrightText = tw.p`bg-clip-text text-xs font-medium text-center mt-6 font-medium tracking-wide md:text-xs lg:text-base text-black font-lato italic`;

const SocialLinksContainer = tw.div`flex flex-row`;

const CPLinksContainer = tw.div`text-center md:text-right text-[0.7rem] lg:text-base flex flex-col font-lato italic font-medium text-black hover:text-primaryPoi25-500`;

const SocialLink = styled.a`
    ${tw`cursor-pointer inline-block text-black hover:text-primaryPoi25-500 transition duration-300 mx-4`}
    svg {
        ${tw`md:w-6 md:h-6 lg:w-12 lg:h-12`}
    }
`;

const LogoImage = styled.img`
    ${tw`rounded-t sm:rounded h-16 sm:w-16 lg:h-20 lg:w-20 mr-2`}
`;

const NavLink = tw.a`
  text-black font-medium tracking-wider transition duration-300
  text-lg lg:text-lg lg:mx-6`;

const LogoContainer = tw.div`flex flex-col justify-between`;

const LogoTitle = tw.h1`text-center md:text-left text-2xl lg:text-5xl font-bold bg-clip-text text-transparent z-10 bg-black bg-clip-text text-transparent font-bold font-playfair`;

const LogoDesc = tw.h3`text-xs lg:text-sm font-bold bg-clip-text text-transparent z-10 bg-black bg-clip-text text-transparent font-bold font-lato italic`;

const LogoLink = styled(NavLink)`
    ${tw`flex flex-col md:flex-row items-center font-black border-b-0 text-4xl! ml-0!`};
`;

const Logo = () => (
    <LogoLink href="/">
        <LogoImage src="/img/landing-page/landing/LOGO POISSON 2025.png" />
        <LogoContainer>
            <LogoTitle>POISSON</LogoTitle>
            <LogoDesc>Statistics Competition 2025</LogoDesc>
        </LogoContainer>
    </LogoLink>
);

const BackgroundContainer = styled.div((props) => [
    `background-image: url("${props.imageSrc}");
  background-position: top center;
  background-size: cover;
  background-repeat: no-repeat;`,
    tw`absolute inset-0 w-full h-full`,
]);

const Transisi = styled.div`
    ${tw`absolute left-0 right-0 w-full z-10 pointer-events-none`}
    height: ${(props) => props.height || "200px"};
    background-size: cover;
    background-repeat: no-repeat;
    ${({ position }) => position === "top" && tw`top-0`}
    ${({ position }) => position === "bottom" && tw`bottom-0`}
  background-image: ${({ img }) => `url(${img})`};
`;

// Component

const Footer = () => {
    const { link } = useContext(Context);
    const { t } = useTranslation();

    return (
        <Container>
            <Transisi position="top" img={transisiFooter} />
            <BackgroundContainer imageSrc={footerBg} />
            <Content>
                <Col>
                    <Row>
                        <LeftContainer>
                            <Logo />
                        </LeftContainer>
                        <RightContainer>
                            <SocialLinksContainer>
                                <SocialLink href="https://www.instagram.com/poisson_stis/">
                                    <InstagramIcon />
                                </SocialLink>
                                <SocialLink href="https://www.tiktok.com/@poisson_stis">
                                    <TiktokLogo />
                                </SocialLink>
                                <SocialLink href="mailto:poisson@stis.ac.id?Subject={{Type%20Here..}}">
                                    <GmailLogo />
                                </SocialLink>
                                <SocialLink href="https://www.youtube.com/@PoissonPolstatSTIS">
                                    <YTLogo />
                                </SocialLink>
                            </SocialLinksContainer>
                            <CPLinksContainer>
                                <SocialLink href="https://wa.me/62895395057241">
                                    CP 1 (WA) : +62 895-3950-57241 (Rayhan)
                                </SocialLink>
                                <SocialLink href="https://wa.me/6285370092159">
                                    CP 2 (WA) : +62 853-7009-2159 (Silvi)
                                </SocialLink>
                                <SocialLink href="https://wa.me/6282193820589">
                                    CP 3 (WA) : +62 821-9382-0589 (Andi)
                                </SocialLink>
                            </CPLinksContainer>
                        </RightContainer>
                    </Row>
                    <CopyrightText>
                        &copy; Copyright 2025, Poisson All Rights Reserved.
                    </CopyrightText>
                </Col>
            </Content>
        </Container>
    );
};

export default Footer;
