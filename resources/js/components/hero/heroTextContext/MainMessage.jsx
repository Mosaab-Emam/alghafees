import { staticContext } from "@/utils/contexts";
import { useContext } from "react";

const MainMessage = () => {
    const static_content = useContext(staticContext);
    return (
        <h1
            className="md:text-[62px] text-[22px] md:leading-[86.8px] leading-[30.8px] font-normal text-Black-01 md:max-w-full max-w-[150px]"
            dangerouslySetInnerHTML={{
                __html: static_content["hero_main_title"],
            }}
        />
    );
};

export default MainMessage;
