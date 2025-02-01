import Container from "@/components/Container";
import { withColoredText } from "@/utils";
import { staticContext } from "@/utils/contexts";
import {
    Bullet,
    OurClientsShape,
    PageTopSection,
    SalehNameEnglishShape,
} from "../../components";
import Layout from "../layout/Layout";
import JoinUsBgImage from "./JoinUsBgImage";
import JoinUsForm from "./JoinUsForm";
import JoinUsTextBox from "./JoinUsTextBox";

const JoinUs = ({
    static_content,
}: {
    static_content: Record<string, string>;
}) => {
    for (let [key, value] of Object.entries(static_content)) {
        static_content[key] = withColoredText(value.toString());
    }

    return (
        <staticContext.Provider value={static_content}>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <Container>
                <section className="md:mt-[8.5rem] lg:mt-[315px] mt-[6rem] xl:mb-[500px] lg:mb-[450px] mb-[38rem]">
                    <div className="relative md:block flex flex-col items-center">
                        <JoinUsBgImage />
                        <JoinUsForm />
                        <JoinUsTextBox />
                    </div>

                    <Bullet
                        blue={true}
                        position={
                            "2xl:left-[6.8rem] xl:left-[9.5rem] xl:top-[69.5rem] lg:left-[4.7rem] lg:top-[67.7rem] -left-2 top-[36.7rem] z-10"
                        }
                    />
                    <SalehNameEnglishShape
                        position={
                            "md:left-[-93px] left-[-31px] md:-bottom-[50rem] bottom-[106rem]"
                        }
                    />
                    <OurClientsShape
                        position={
                            "md:flex hidden right-[-6rem] -bottom-[29rem] z-[-1]"
                        }
                    />
                </section>
            </Container>
        </staticContext.Provider>
    );
};

JoinUs.layout = (page: React.ReactNode) => <Layout children={page} />;

export default JoinUs;
