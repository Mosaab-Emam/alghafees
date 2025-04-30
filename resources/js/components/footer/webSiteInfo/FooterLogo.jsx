import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { FooterLogoSvg } from "../../../assets/images/footer";
import ParagraphContent from "../../ParagraphContent";

const FooterLogo = () => {
    const static_content = useContext(staticContext);

    return (
        <div className="flex flex-col items-start gap-6 md:w-[221px] w-full">
            <FooterLogoSvg className="lg:w-[122px] xl:w-[129px] w-[85px] lg:h-[120px] xl:h-[166px] h-[109.38px]" />
            <ParagraphContent>{static_content["description"]}</ParagraphContent>
        </div>
    );
};

export default FooterLogo;
