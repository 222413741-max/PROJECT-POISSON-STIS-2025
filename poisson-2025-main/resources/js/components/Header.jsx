import React, { useContext, useState } from "react";
import { motion } from "framer-motion";
import styled, { keyframes } from "styled-components";
import tw from "twin.macro";
import Cookies from "js-cookie";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faChevronDown, faChevronUp } from "@fortawesome/free-solid-svg-icons";
import { PrimaryButton as PrimaryButtonBase } from "./misc/Buttons";

import Context from "../helpers/Context";
import useAnimatedNavToggler from "../helpers/useAnimatedNavToggler";
import { useTranslation } from "react-i18next";

// import { ReactComponent as MenuIcon } from "feather-icons/dist/icons/menu.svg";
// import { ReactComponent as CloseIcon } from "feather-icons/dist/icons/x.svg";
import * as Icon from "react-feather";

const MenuIcon = Icon.Menu;
const CloseIcon = Icon.X;

// Styled Component
const HeaderBase = styled.header`
    ${tw`flex justify-between items-center max-w-none mx-auto py-2 px-6 z-50`}
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 6rem;

    background: #fefce8;
    border-radius: 5px;
    backdrop-filter: blur(2px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
`;

const NavLinks = tw.div`inline-block`;

const NavLink = tw.a`
  text-black font-medium tracking-wider transition duration-300
  text-lg lg:text-lg lg:mx-6
`;

const PrimaryLink = tw(NavLink)`
  py-1 font-medium
`;

const LogoLink = styled(NavLink)`
    ${tw`flex items-center font-black border-b-0 text-4xl! ml-0!`};
`;

const MobileNavLinksContainer = tw.nav`relative flex flex-1 items-center justify-between z-30`;

const NavToggle = tw.button`flex w-full justify-end text-orange-500 z-0 focus:border-none hocus:text-primary-500 transition duration-300`;

const MobileNavLinks = motion(styled.div`
    ${tw`absolute lg:hidden fixed top-0 inset-x-0 mx-4 my-6 p-8 border-2 border-primaryPoi25-500 text-center rounded-lg text-gray-900 bg-primaryPoi25 z-30`}
    ${NavLinks} {
        ${tw`flex flex-col items-center`}
    }
`);

const DesktopNavLinks = tw.nav`hidden lg:flex flex-1 justify-between items-center`;

const collapseBreakPointCssMap = {
    sm: {
        mobileNavLinks: tw`sm:hidden`,
        desktopNavLinks: tw`sm:flex`,
        mobileNavLinksContainer: tw`sm:hidden`,
    },
    md: {
        mobileNavLinks: tw`md:hidden`,
        desktopNavLinks: tw`md:flex`,
        mobileNavLinksContainer: tw`md:hidden`,
    },
    lg: {
        mobileNavLinks: tw`lg:hidden`,
        desktopNavLinks: tw`lg:flex`,
        mobileNavLinksContainer: tw`lg:hidden`,
    },
    xl: {
        mobileNavLinks: tw`lg:hidden`,
        desktopNavLinks: tw`lg:flex`,
        mobileNavLinksContainer: tw`lg:hidden`,
    },
};

const LogoImage = styled.img`
    ${tw`rounded-t sm:rounded h-16 sm:w-16 lg:h-20 lg:w-20 mr-2`}
`;

const LogoContainer = tw.div`flex flex-col justify-between`;
const LogoTitle = tw.h1`text-4xl lg:text-5xl font-bold bg-clip-text text-transparent z-10 bg-black bg-clip-text text-transparent font-bold font-playfair`;

const LogoDesc = tw.h3`text-xs lg:text-sm font-bold bg-clip-text text-transparent z-10 bg-black bg-clip-text text-transparent font-bold font-lato italic`;

const Logo = () => (
    <LogoLink href="/">
        <LogoImage src="/img/landing-page/landing/LOGO POISSON 2025.png" />
        <LogoContainer>
            <LogoTitle>POISSON</LogoTitle>
            <LogoDesc>Statistics Competition 2025</LogoDesc>
        </LogoContainer>
    </LogoLink>
);

const transparentShow = keyframes`
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
`;

const LangWrapper = styled.div`
    ${tw`flex justify-end z-10 lg:ml-4 lg:mt-0 sm:ml-0 sm:mt-4`}
    @media (max-width: 1165px) {
        ${tw`mt-4`}
    }
`;

const LangDropdown = tw.div`relative flex items-center justify-between bg-white cursor-pointer py-2 px-4 rounded w-[120px]`;

const LangDropdownContent = tw.div`flex gap-2 items-center w-full`;

const LangDropdownList = styled.div`
    ${tw`absolute bg-white top-[45px] left-0 cursor-pointer w-full rounded-[5px]`}
    display: none;
    animation: ${transparentShow} 1s ease-in-out;
`;

const LangDropdownItem = tw.div`flex items-center hover:bg-gray-300 gap-2 py-2 px-4 rounded-[5px] w-full`;

const CountryFlag = styled.img`
    height: 20px;
    width: 30px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
`;

const Link = () => {
    const { link } = useContext(Context);
    const { t, i18n } = useTranslation();

    const [selectedLang, setSelectedLang] = useState(
        Cookies.get("lang") || "en"
    );
    const handleLangChange = (e) => {
        const lang = e.target.getAttribute("value");
        if (i18n.language !== lang) {
            i18n.changeLanguage(lang);
            Cookies.set("lang", lang);
            setSelectedLang(lang);
        }
    };

    const [isClick, setIsClick] = useState(false);
    const clickDropdown = () => {
        setIsClick(!isClick);
    };

    const Lang = () => (
        <LangWrapper>
            <LangDropdown onClick={clickDropdown}>
                <LangDropdownContent>
                    <CountryFlag
                        src={
                            selectedLang === "en"
                                ? "/img/en.png"
                                : "/img/id.png"
                        }
                    />
                    <span tw="w-full">
                        {selectedLang === "en" ? "EN" : "ID"}
                    </span>
                    <FontAwesomeIcon
                        icon={isClick ? faChevronUp : faChevronDown}
                    />
                </LangDropdownContent>
                <LangDropdownList
                    style={isClick ? { display: "block" } : { display: "none" }}
                >
                    <LangDropdownItem onClick={handleLangChange} value="en">
                        <CountryFlag src="/img/en.png" value="en" />
                        <span value="en">EN</span>
                    </LangDropdownItem>
                    <LangDropdownItem onClick={handleLangChange} value="id">
                        <CountryFlag src="/img/id.png" value="id" />
                        <span value="id">ID</span>
                    </LangDropdownItem>
                </LangDropdownList>
            </LangDropdown>
        </LangWrapper>
    );

    const NavEnds = styled.div`
        ${tw`flex lg:flex-row items-center sm:justify-center sm:flex-col`}
        @media (max-width: 1165px) {
            ${tw`flex-col`}
        }
    `;

    return (
        <>
            <NavLinks>
                {link.map((item, i) => (
                    <NavLink key={i} href={item.url}>
                        {t("navlink." + item.name)}
                    </NavLink>
                ))}
            </NavLinks>
            <NavEnds>
                <NavLinks>
                    <NavLink href="/login">{t("masuk")}</NavLink>
                    <PrimaryLink href="/register">{t("daftar")}</PrimaryLink>
                </NavLinks>
                <Lang />
            </NavEnds>
        </>
    );
};

// Component
const Header = ({ className, collapse = "lg" }) => {
    const { showNavLinks, animation, toggleNavbar } = useAnimatedNavToggler();
    const collapseBreakpointCss = collapseBreakPointCssMap[collapse];
    return (
        <HeaderBase className={className || "header-light"}>
            <DesktopNavLinks css={collapseBreakpointCss.desktopNavLinks}>
                <Logo />
                <Link />
            </DesktopNavLinks>
            <MobileNavLinksContainer
                css={collapseBreakpointCss.mobileNavLinksContainer}
            >
                <Logo />
                <MobileNavLinks
                    initial={{ x: "150%", display: "none" }}
                    animate={animation}
                    css={collapseBreakpointCss.mobileNavLinks}
                >
                    <NavToggle
                        onClick={toggleNavbar}
                        className={showNavLinks ? "open" : "closed"}
                    >
                        {showNavLinks ? (
                            <CloseIcon className="w-6 h-6 stroke-black hover:stroke-white transition-colors duration-300" />
                        ) : (
                            <MenuIcon className="w-6 h-6 stroke-black hover:stroke-white transition-colors duration-300" />
                        )}
                    </NavToggle>
                    <Link />
                </MobileNavLinks>
                <NavToggle
                    onClick={() => {
                        toggleNavbar();
                    }}
                    className={showNavLinks ? "open" : "closed"}
                >
                    {showNavLinks ? (
                        <CloseIcon className="w-6 h-6 stroke-black hover:stroke-white transition-colors duration-300" />
                    ) : (
                        <MenuIcon className="w-6 h-6 stroke-black hover:stroke-white transition-colors duration-300" />
                    )}
                </NavToggle>
            </MobileNavLinksContainer>
        </HeaderBase>
    );
};

export default Header;
