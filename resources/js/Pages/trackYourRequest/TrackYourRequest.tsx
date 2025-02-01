import React from "react";
import {
    PageTopSection,
    SalehNameEnglishShape,
    TrackRequestShape,
} from "../../components";
import Layout from "../layout/Layout";

import Container from "@/components/Container";
import { withColoredText } from "@/utils";
import { staticContext } from "@/utils/contexts";
import TrackRequestForm from "./TrackRequestForm";

const TrackYourRequest = ({
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
                <section className="mt-[6rem] md:mt-48 lg:mb-[131px] mb-[6rem] relative">
                    <div className="flex lg:inline-flex md:flex-row flex-col-reverse md:justify-between lg:items-center lg:content-start content-center items-start xl:gap-[144px] lg:gap-[60px] gap-8">
                        <TrackRequestForm />
                        <TrackRequestShape />
                    </div>

                    <SalehNameEnglishShape
                        position={
                            "2xl:left-8 xl:-left-12 md:left-[-93px] left-[-120px]  md:top-0 top-[22rem] z-[1]"
                        }
                    />
                </section>
            </Container>
        </staticContext.Provider>
    );
};

TrackYourRequest.layout = (page: React.ReactNode) => <Layout children={page} />;

export default TrackYourRequest;
