import React, { Fragment } from "react"
import { FlatList, Text } from "react-native"
import ItemListCountryPhone from "../molecules/ItemListCountryPhone"

const ListCountryPhone = () => {
    const country = [
        {
            flag: require("../../assets/images/indonesia.png"),
            name: "Indonesia",
            code: {
                display: "+62",
                real: "0"
            }
        },
        {
            flag: require("../../assets/images/indonesia.png"),
            name: "Indonesia",
            code: {
                display: "+63",
                real: "0"
            }
        },
        {
            flag: require("../../assets/images/indonesia.png"),
            name: "Indonesia",
            code: {
                display: "+64",
                real: "0"
            }
        },
        {
            flag: require("../../assets/images/indonesia.png"),
            name: "Indonesia",
            code: {
                display: "+65",
                real: "0"
            }
        },
        {
            flag: require("../../assets/images/indonesia.png"),
            name: "Indonesia",
            code: {
                display: "+66",
                real: "0"
            }
        },
        {
            flag: require("../../assets/images/indonesia.png"),
            name: "Indonesia",
            code: {
                display: "+67",
                real: "0"
            }
        },
        {
            flag: require("../../assets/images/indonesia.png"),
            name: "Indonesia",
            code: {
                display: "+68",
                real: "0"
            }
        },
        {
            flag: require("../../assets/images/indonesia.png"),
            name: "Indonesia",
            code: {
                display: "+69",
                real: "0"
            }
        },
        {
            flag: require("../../assets/images/indonesia.png"),
            name: "Indonesia",
            code: {
                display: "+610",
                real: "0"
            }
        }
    ]

    return (
        <Fragment>
            <FlatList
                data={ country }
                keyExtractor={ (item, index) => `${ item.name }-${ index }` }
                renderItem={ ({ item }) => {
                    return <ItemListCountryPhone item={ item }/>
                } }
            />
        </Fragment>
    )
}

export default ListCountryPhone