import React, { useContext } from "react";
import {
    PageTopSection,
    SalehNameEnglishShape,
    TrackRequestShape,
} from "../../components";
import Layout from "../layout/Layout";

import Container from "@/components/Container";
import { staticContext } from "@/utils/contexts";
import TrackRequestForm from "./TrackRequestForm";

const TrackYourRequest = () => {
    const static_content = useContext<Record<string, string>>(staticContext);

    return (
        <>
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
        </>
    );
};

TrackYourRequest.layout = (page: React.ReactNode) => <Layout children={page} />;

export default TrackYourRequest;
