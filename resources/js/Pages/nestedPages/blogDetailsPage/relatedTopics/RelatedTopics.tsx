import { Post } from "@/types";
import RelatedTopicsSlider from "./RelatedTopicsSlider";

export default function RelatedTopics({
    related_posts,
}: {
    related_posts: Array<Post>;
}) {
    return (
        <section className="xl:mb-[100px] lg:mb-[50px] mb-[180px]">
            <h3 className="head-line-h3 text-right text-Black-01 lg:mb-4 mb-[48px]">
                مواضيع ذات صلة
            </h3>

            <RelatedTopicsSlider posts={related_posts} />
        </section>
    );
}
