import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import SectionContentBox from "../SectionContentBox";

const TextContentBox = () => {
    const static_content = useContext(staticContext);

    return (
        <SectionContentBox
            sectionTitle={static_content["clients_small_top_title"]}
            textContent={static_content["clients_main_title"]}
            paragraphContent={static_content["clients_description"]}
            className="w-[492px] flex flex-col items-start gap-[32px]"
            textContentWidth="w-full"
            sectionTitleTextColor="text-primary-600"
            textContentTextColor="text-Black-01"
            paragraphContentTextColor="text-Gray-scale-02"
            butWidth="w-[180px]"
            navigateTo={static_content["clients_button_link"]}
            btnText={static_content["clients_button_text"]}
        />
    );
};

export default TextContentBox;
