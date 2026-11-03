import React, { useContext } from "react";
import styled from "styled-components";
import tw from "twin.macro";
import Context from "../helpers/Context";

import { Container as ContainerBase } from "./misc/Layouts";

// import logo from "images/logo.svg";
// import { ReactComponent as InstagramIcon } from "images/instagram.svg";
// import { ReactComponent as TiktokLogo } from "images/tiktok-logo.svg";
// import { ReactComponent as GmailLogo } from "images/gmail-logo.svg";

import { logo } from "../config";
import SvgInstagram from "./svgJSX/Instagram";
import SvgTiktokLogo from "./svgJSX/TiktokLogo";
import SvgGmailLogo from "./svgJSX/GmailLogo";

const InstagramIcon = SvgInstagram;
const TiktokLogo = SvgTiktokLogo;
const GmailLogo = SvgGmailLogo;

// Styled Component
const Container = tw(ContainerBase)`bg-gray-900 text-gray-100 -mx-8 -mb-8`;

const Content = tw.div`max-w-screen-xl mx-auto py-20 lg:py-24`;

const Row = tw.div`flex items-center justify-center flex-col px-8`;

const LogoContainer = tw.div`flex items-center justify-center md:justify-start`;

const LogoImg = tw.img`w-8`;

const LogoText = tw.h5`ml-2 text-2xl font-black tracking-wider`;

const LinksContainer = tw.div`mt-8 font-medium flex flex-wrap justify-center items-center flex-col sm:flex-row`;

const Link = tw.a`border-b-2 border-transparent hocus:text-purple hocus:border-purple pb-1 transition duration-300 mt-2 mx-4`;

const CopyrightText = tw.p`text-center mt-10 font-medium tracking-wide text-sm text-purple`;

const SocialLinksContainer = tw.div`mt-10`;

const CPLinksContainer = tw.div`mt-5 text-sm`;

const SocialLink = styled.a`
    ${tw`cursor-pointer inline-block text-gray-100 hover:text-purple transition duration-300 mx-4`}
    svg {
        ${tw`w-5 h-5`}
    }
`;

// Component

const Footer = () => {
    const { link } = useContext(Context);
    return (
        <Container>
            <Content>
                <Row>
                    <LogoContainer>
                        <LogoImg src={logo} />
                        <LogoText>
                            POISSON <span tw="text-purple">2024</span>
                        </LogoText>
                    </LogoContainer>
                    <LinksContainer>
                        {link.map((item, i) => (
                            <Link key={i} href={item.url}>
                                {item.name}
                            </Link>
                        ))}
                    </LinksContainer>
                    <CPLinksContainer>
                        <SocialLink href="https://wa.me/6281269155695">
                            Contact Person 1 (WA) : +62 812-6915-5695 (Sisilia)
                        </SocialLink>
                    </CPLinksContainer>
                    <CPLinksContainer>
                        <SocialLink href="https://wa.me/6282133673575">
                            Contact Person 2 (WA) : +62 821-3367-3575 (Erika)
                        </SocialLink>
                    </CPLinksContainer>
                    <SocialLinksContainer>
                        <SocialLink href="https://www.instagram.com/poisson_stis/">
                            <InstagramIcon />
                        </SocialLink>
                        <SocialLink href="https://www.tiktok.com/@poissonstis">
                            <TiktokLogo />
                        </SocialLink>
                        <SocialLink href="mailto:poisson@stis.ac.id?Subject={{Type%20Here..}}">
                            <GmailLogo />
                        </SocialLink>
                    </SocialLinksContainer>
                    <CopyrightText>
                        &copy; Copyright 2023, Poisson All Rights Reserved.
                    </CopyrightText>
                </Row>
            </Content>
        </Container>
    );
};

export default Footer;
