import Container from "@/components/Container";
import TabButton from "@/components/reportsSection/tabsButtonBox/TabButton";
import { staticContext } from "@/utils/contexts";
import { ArrowDownIcon } from "lucide-react";
import { useContext, useState } from "react";
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
import TraineeApplicationForm from "./_components/TraineeApplicationForm";

const JoinUs = () => {
    const static_content = useContext<Record<string, string>>(staticContext);
    const [activeTab, setActiveTab] = useState(0);

    return (
        <>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <Container>
                <section className="md:mt-[8.5rem] lg:mt-[360px] mt-[6rem] xl:mb-[500px] lg:mb-[450px] mb-[38rem]">
                    <div className="relative md:block flex flex-col items-center">
                        <div className="flex flex-col items-end gap-8">
                            <div className="hidden lg:flex items-start justify-center gap-[20px] self-stretch absolute lg:-translate-y-[200px] xl:-translate-y-[220px] z-50 2xl:left-[16.3rem] xl:left-[10rem] lg:left-[2rem] left-0 ">
                                <TabButton
                                    index={0}
                                    activeTab={activeTab}
                                    onActiveHandler={() => setActiveTab(0)}
                                >
                                    موظف
                                </TabButton>
                                <TabButton
                                    index={1}
                                    activeTab={activeTab}
                                    onActiveHandler={() => setActiveTab(1)}
                                >
                                    متدرب
                                </TabButton>
                            </div>
                        </div>

                        <JoinUsBgImage />
                        <div className="flex items-start gap-[20px] self-stretch justify-center relative -translate-y-20 md:-translate-y-0 lg:hidden z-50">
                            <TabButton
                                index={0}
                                activeTab={activeTab}
                                onActiveHandler={() => setActiveTab(0)}
                            >
                                موظف
                            </TabButton>
                            <TabButton
                                index={1}
                                activeTab={activeTab}
                                onActiveHandler={() => setActiveTab(1)}
                            >
                                متدرب
                            </TabButton>
                        </div>
                        {activeTab === 0 && <JoinUsForm />}
                        {activeTab === 1 && <TraineeApplicationForm />}
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
        </>
    );
};

JoinUs.layout = (page: React.ReactNode) => <Layout children={page} />;

export default JoinUs;
