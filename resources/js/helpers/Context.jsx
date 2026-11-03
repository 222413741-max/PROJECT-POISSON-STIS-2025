import { createContext } from "react";
import config from "../config";

const Context = createContext();

const ContextProvider = (props) => {
    return <Context.Provider value={config}>{props.children}</Context.Provider>;
};

export { ContextProvider };
export default Context;
