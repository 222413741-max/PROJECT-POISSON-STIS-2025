import React, { useContext } from 'react'
import { motion } from 'framer-motion'
import styled from 'styled-components'
import tw from 'twin.macro'

import Context from '../helpers/Context'
import useAnimatedNavToggler from '../helpers/useAnimatedNavToggler'
// import { ReactComponent as MenuIcon } from "feather-icons/dist/icons/menu.svg";
// import { ReactComponent as CloseIcon } from "feather-icons/dist/icons/x.svg";
import * as Icon from 'react-feather'

const MenuIcon = Icon.Menu
const CloseIcon = Icon.X

// Styled Component
const HeaderBase = tw.header`flex justify-between items-center max-w-none mx-auto`

const NavLinks = tw.div`inline-block`

const NavLink = tw.a`
  text-lg my-2 lg:text-sm lg:mx-6 lg:my-0 text-white
  font-semibold tracking-wider transition duration-300
  pb-1 border-b-2 border-transparent hover:border-purple hocus:text-purple
`

const PrimaryLink = tw(NavLink)`
  lg:mx-0 px-8 py-3 rounded-full bg-gradient-to-r from-orange to-purple text-gray-100
  focus:shadow-outline border-b-0 opacity-[90%] hover:opacity-100 hover:text-gray-100
`

const LogoLink = styled(NavLink)`
  ${tw`flex items-center font-black text-white border-b-0 text-4xl! ml-0!`};
`

const AfterLogoLink = tw.span`w-3 h-3 bg-purple rounded-full inline-block -mb-2`

const MobileNavLinksContainer = tw.nav`flex flex-1 items-center justify-between z-30`

const NavToggle = tw.button`flex w-full justify-end text-orange lg:hidden z-0 focus:outline-none hocus:text-primary-500 transition duration-300`

const MobileNavLinks = motion(styled.div`
  ${tw`lg:hidden z-10 fixed top-0 inset-x-0 mx-4 my-6 p-8 border-2 border-purple text-center rounded-lg text-gray-900 bg-primary`}
  ${NavLinks} {
    ${tw`flex flex-col items-center`}
  }
`)

const DesktopNavLinks = tw.nav`hidden lg:flex flex-1 justify-between items-center`

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
}

// Local Component
const Logo = () => (
  <LogoLink href="/">
    POISSON <AfterLogoLink />
  </LogoLink>
)

const Link = () => {
  const { link } = useContext(Context)
  return (
    <>
      <NavLinks>
        {link.map((item, i) => (
          <NavLink key={i} href={item.url}>
            {item.name}
          </NavLink>
        ))}
      </NavLinks>
      <NavLinks>
        <NavLink href="/login" tw="lg:ml-12!">
          Masuk
        </NavLink>
        <PrimaryLink href="/register">Daftar</PrimaryLink>
      </NavLinks>
    </>
  )
}

// Component
const Header = ({ className, collapse = 'lg' }) => {
  const { showNavLinks, animation, toggleNavbar } = useAnimatedNavToggler()
  const collapseBreakpointCss = collapseBreakPointCssMap[collapse]
  return (
    <HeaderBase className={className || 'header-light'}>
      <DesktopNavLinks css={collapseBreakpointCss.desktopNavLinks}>
        <Logo />
        <Link />
      </DesktopNavLinks>

      <MobileNavLinksContainer
        css={collapseBreakpointCss.mobileNavLinksContainer}
      >
        <Logo />
        <MobileNavLinks
          initial={{ x: '150%', display: 'none' }}
          animate={animation}
          css={collapseBreakpointCss.mobileNavLinks}
        >
          <NavToggle
            onClick={toggleNavbar}
            className={showNavLinks ? 'open' : 'closed'}
          >
            {showNavLinks ? (
              <CloseIcon tw="w-6 h-6" />
            ) : (
              <MenuIcon tw="w-6 h-6" />
            )}
          </NavToggle>
          <Link />
        </MobileNavLinks>
        <NavToggle
          onClick={() => {
            toggleNavbar()
          }}
          className={showNavLinks ? 'open' : 'closed'}
        >
          {showNavLinks ? (
            <CloseIcon className="w-6 h-6" />
          ) : (
            <MenuIcon className="w-6 h-6 hidden" />
          )}
        </NavToggle>
      </MobileNavLinksContainer>
    </HeaderBase>
  )
}

export default Header
