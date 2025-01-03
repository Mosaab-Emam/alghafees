import { useEffect } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import EventsMainContent from "./EventsMainContent";

export default function Events() {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <Layout>
            <PageTopSection
                title={"الفعاليات"}
                description={"أحدث الفعاليات"}
            />
            <EventsMainContent />
        </Layout>
    );
}
