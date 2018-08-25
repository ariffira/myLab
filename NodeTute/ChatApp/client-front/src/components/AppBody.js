import React, { Component } from 'react';
import { Button, Container, Row } from 'reactstrap';

class AppBody extends Component {

    render() {
        return (
            <Container>
            <Row>
                <Button color="primary" size="lg">Create Chat Room</Button>{' '}
                <Button color="danger" size="lg">Register</Button>
            </Row>
            </Container>
        );
    }
}

export default AppBody;